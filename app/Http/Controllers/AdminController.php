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

class AdminController extends Controller
{
      
    public function dashboard()
    {
        $users = User::all();
        $checkouts = Checkout::all()->where('status', 3);
        return view('admin.dashboard', compact('checkouts','users'));
        
    }

    public function admin()
    {
        return view('admin.login');
    }

    public function konfirmasi($id)
    {
        
        $checkout = Checkout::where('id',$id)->where('status', 3)->first();
        $checkout->status = 4;
        $checkout->update();

        alert()->success('Bukti Pembayaran Berhasil DiKonfirmasi', 'Success');
        return redirect()->route('admin.dashboard');
    }
}
