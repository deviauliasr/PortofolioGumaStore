@extends('layouts.app')

@section('content')
    <!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-t-92">
		<!-- breadcrumb -->
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="home" class="stext-109 cl8 hov-cl1 trans-04">
                    Home
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
                <a href="history" class="stext-109 cl8 hov-cl1 trans-04">
                    History
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
                <span class="stext-109 cl4">
                    Detail Order
                </span>
            </div>
        </div>
	</section>
	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Order</h4>
						<ul class="list">
							<li><a href="#"><span width="10">Order number</span> : 000{{ $checkout->id }}</a></li>
							<li><a href="#"><span>Date</span> : {{ $checkout->tanggal_checkout }}</a></li>
							<li><a href="#"><span>Total</span> : IDR {{number_format($checkout->harga_total_kirim)}}</a></li>
							<li><a href="#"><span>Payment method</span> : {{ $checkout->bayar }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Pengiriman</h4>
						<ul class="list">
							<li><a href="#"><span width="10">Name</span> : {{ $user->name }}</a></li>
							<li><a href="#"><span>Email</span> : {{ $user->email }}</a></li>
							<li><a href="#"><span>Phone</span> : {{ $user->no_hp }}</a></li>
							<li><a href="#"><span>Address</span> : {{ $user->alamat }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Pembayaran</h4>
						<ul class="list">
							<li><a href="#"><span>Status</span> : 
                                    @if( $checkout->status == 2)
                                    Menunggu Bukti Pembayaran
                                    @elseif( $checkout->status == 3)
                                    Memproses Bukti Pembayaran
									@elseif( $checkout->status == 4)
                                    Pesanan Dikirim
                                    @endif
                            </a></li>
							<li><div class="box box-primary">
									<form method="POST" action="{{ url('up-bukti')}}/{{ $checkout->id}}"  enctype="multipart/form-data">
										@csrf
										<div class="box-body">
											<div class="form-group">
												<label for="bukti_transfer">Upload Bukti Transfer</label>
												<input class="form-input" id="bukti_transfer" type="file" name="bukti_transfer">
											</div>
										</div>

										<div class="box-footer">
											<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn1 p-lr-15 trans-04 pointer">Upload</button>
										</div>
									</form>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Order Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th align="center">Product</th>
                                <th align="center"></th>
								<th align="center">Quantity</th>
								<th align="center">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($keranjangs as $keranjang)
							<tr>
                                <td>
                                    <div class="how-itemcart1">
									    <img src="{{url ('frontend/images') }}/{{ $keranjang->barang->foto_barang }}" alt="IMG-PRODUCT">
                                    </div>
                                    
                                </td>
                                <td>
                                    <p>{{ $keranjang->barang->nama_barang}}</p>
								</td>
								<td>
									<h5>x{{ $keranjang->jumlah_pemesanan}}</h5>
								</td>
								<td>
									<p>IDR {{ number_format($keranjang->jumlah_harga)}}</p>
								</td>
							</tr>
							@endforeach
							<tr>
								<td>
									<h4></h4>
								</td>
                                <td>
									<h4></h4>
								</td>
								<td>
									<h5>Subtotal</h5>
								</td>
								<td>
									<p>IDR {{number_format($checkout->harga_total)}}</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4></h4>
								</td>
                                <td>
									<h4></h4>
								</td>
								<td>
									<h5>Shipping</h5>
								</td>
								<td>
									<p>Flat rate: IDR {{number_format($checkout->ongkos_kirim)}}</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4></h4>
								</td>
                                <td>
									<h4></h4>
								</td>
								<td>
									<h5>Total</h5>
								</td>
								<td>
									<p>IDR {{number_format($checkout->harga_total_kirim)}}</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
            <div class="flex-w bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                <a class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" href="{{ url('home') }}">
                    Continue Shopping
                </a>
                <!-- <a class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                    Update Cart
                </a> -->
                
            </div>
		</div>
	</section>
	<!--================End Order Details Area =================-->
@endsection