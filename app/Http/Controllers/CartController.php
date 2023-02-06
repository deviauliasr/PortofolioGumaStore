<?php

namespace App\Http\Controllers;
use App\User;
use App\Barang;
use App\Checkout;
use App\Keranjang;
use Auth;
use SweetAlert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();
        return view('cart.detail', compact('barang'));
    }

    public function add(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        // Cek sisa Stok
        if($request->banyak_pesan > $barang->stok_barang)
        {
            alert()->error('The amount you entered exceeds the stock', 'Error');
            return redirect('detail/'.$id);
        }
         
        // Cek eksistensi Checkout
        $cek_checkout = Checkout::where('user_id', Auth::user()->id)->where('status',0)->first();
        
        // Simpan ke dalam Checkout
        if(empty($cek_checkout))
        {
            $checkout = new Checkout;
            $checkout->user_id = Auth::user()->id;
            $checkout->tanggal_checkout = $tanggal; 
            $checkout->status = 0;
            $checkout->harga_total = 0;
            $checkout->ongkos_kirim = 0;
            $checkout->harga_total_kirim = 0;
            $checkout->save();
        }
        
        // Simpan ke dalam Keranjang
        $checkout_rekap = Checkout::where('user_id', Auth::user()->id)->where('status',0)->first();
        
        // Cek Keranjang
        $cek_keranjang = Keranjang::where('barang_id', $barang->id)->where('checkout_id', $checkout_rekap->id)->first();
        
        if(empty($cek_keranjang))
        {
            $keranjang= new Keranjang;
            $keranjang->barang_id = $barang->id;
            $keranjang->checkout_id = $checkout_rekap->id;
            $keranjang->jumlah_pemesanan = $request->banyak_pesan;
            $keranjang->jumlah_harga = $barang->harga_barang*$request->banyak_pesan;
            $keranjang->save(); 
        }
        else
        {
            $keranjang = Keranjang::where('barang_id', $barang->id)->where('checkout_id', $checkout_rekap->id)->first();
            $keranjang->jumlah_pemesanan = $keranjang->jumlah_pemesanan+$request->banyak_pesan;
            $jumlah_harga_update = $barang->harga_barang*$request->banyak_pesan;
            $keranjang->jumlah_harga = $keranjang->jumlah_harga+$jumlah_harga_update;
            $keranjang->update();
        }
        
        // Jumlah Total
        $checkout = Checkout::where('user_id', Auth::user()->id)->where('status',0)->first();
        $checkout->harga_total = $checkout->harga_total+$barang->harga_barang*$request->banyak_pesan;
        $checkout->update();

        alert()->success('Item added to cart', 'Success');
        return redirect('cart');
    }

    public function tas()
    {

        $checkout = Checkout::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(!empty($checkout))
        {
            $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();
            return view('cart.cart', compact('checkout', 'keranjangs'));
        }
        else
        {
            return view('cart.cart');
        }
                       
    }
    
    public function delete($id)
    {
        $customer = Checkout::where('user_id', Auth::user()->id )->where('status', 0)->first();
		if(!empty($customer))
		{
			$barang_cust = Keranjang::where('checkout_id', $customer->id);
            if( count($barang_cust) != 1)
            {
                $keranjang = Keranjang::where('id', $id)->first();
                $checkout = Checkout::where('id', $keranjang->checkout_id)->where('status', 0)->first();
                $checkout->harga_total = $checkout->harga_total-$keranjang->jumlah_harga;
                $keranjang->delete();
                $checkout->update();
                
                alert()->success('Item deleted', 'Success');
                return redirect('cart');
            }
            else
            {
                $keranjang = Keranjang::where('id', $id)->first();
                $checkout = Checkout::where('id', $keranjang->checkout_id)->where('status', 0)->first();
                $checkout->harga_total = $checkout->harga_total-$keranjang->jumlah_harga;
                $keranjang->delete();
                $customer->delete();
                
                alert()->success('Item deleted', 'Success');
                return redirect('cart'); 
            }
        }

    }

    public function checkout()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $checkout = Checkout::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if( $checkout->status == 1)
        {
            $checkout_id = $checkout->id;
            $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();
            return view('cart.check-out', compact('user', 'checkout', 'keranjangs'));
        }

        $checkout->status = 1;
        $checkout->update();

        $checkout_id = $checkout->id;
        $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();
        foreach ($keranjangs as $keranjang)
        {
            $barang = Barang::where('id', $keranjang->barang_id)->first();
            $barang->stok_barang = $barang->stok_barang-$keranjang->jumlah_pemesanan;
            $barang->update();
        }

        alert()->success('Checkout Success', 'Success');
        return view('cart.check-out', compact('user', 'checkout', 'keranjangs'));


    }

    public function uppost(Request $request)
    {
        
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->number;
        $user->alamat = $request->add1;
        $user->update();

    
        alert()->success('Billing Details updated', 'Success');
        return redirect('check-out');
    }

    public function bukti(Request $request, $id)
    {
        
        $user = User::where('id', Auth::user()->id)->first();
        $checkout = Checkout::where('id', $id)->first();
        $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();
        
        if($request->hasfile('bukti_transfer'))
        {
            $file = $request->file('bukti_transfer');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/bukti_transfer',$filename);
            $checkout->bukti_transfer = $filename;
        }
        else
        {
            return $request;
            $checkout->bukti_transfer = '';
        }
        $checkout->status = 3;
        $checkout->save();

        alert()->success('Berhasil Mengunggah Bukti Pembayaran', 'Success');
        return view('history.detail', compact('user', 'checkout', 'keranjangs'));
    }

    public function checkpost(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $checkout = Checkout::where('user_id', Auth::user()->id)->where('status', 1)->first();
        if( $checkout->status == 2)
        {
            $checkout_id = $checkout->id;
            $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();
            return view('history.detail', compact('user', 'checkout', 'keranjangs'));
        }
        $checkout->bayar = $request->selector;
        $checkout->ongkos_kirim = 50000;
        $checkout->harga_total_kirim = $checkout->harga_total+$checkout->ongkos_kirim;
        $checkout->status = 2;
        $checkout->update();

        $checkout_id = $checkout->id;
        $keranjangs = Keranjang::where('checkout_id', $checkout->id)->get();

        alert()->success('Silahkan Upload Bukti Pembayaran', 'Success');
        return view('history.detail', compact('user', 'checkout', 'keranjangs'));
    }
}