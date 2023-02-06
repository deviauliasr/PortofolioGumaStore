@extends('layouts.app')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('frontend/images/bg-01.jpg');">
		<!-- breadcrumb -->
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="home" class="stext-109 cl8 hov-cl1 trans-04">
                    Home
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    Cart
                </span>
            </div>
        </div>
        <h2 class="ltext-105 cl0 txt-center">
			Keranjang
		</h2>
	</section>

    <!--================Cart Area =================-->
    <section>
        <!-- Shoping Cart -->
        @if(!empty($checkout)) 
        <form class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th align="center">Price</th>
                                        <th align="center">Quantity</th>
                                        <th align="center">Total</th>
                                        <th align="center">Action</th>
                                    </tr>
                                    @foreach($keranjangs as $keranjang)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{url ('frontend/images') }}/{{ $keranjang->barang->foto_barang }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2" align="center">{{ $keranjang->barang->nama_barang}}</td>
                                        <td align="center">Rp {{ number_format($keranjang->barang->harga_barang)}}</td>
                                        <td align="center">{{ $keranjang->jumlah_pemesanan }}</td>
                                        <td align="center">Rp {{ number_format($keranjang->jumlah_harga)}}</td>
                                        <td align="center">
                                            <form method="post" action="{{ url('cart') }}/{{ $keranjang->id }}">
                                            @method('delete')
                                            @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <a class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" href="home">
                                    Continue Shopping
                                </a>
                                <!-- <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Update Cart
                                </div>
                                -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Subtotal:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        Rp {{number_format($checkout->harga_total)}}
                                    </span>
                                </div>
                            </div>

                            <a class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="check-out">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        @else
        <div class="bg0 p-t-75 p-b-85" align="center">
		    <h2 class="ltext-101 cl2 txt-center">
			Your Cart is Empty
		    </h2>
        </div>
		@endif
           
    </section>
    <!--================End Cart Area =================-->
@endsection