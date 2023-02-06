@extends('layouts.app')

@section('content')
    <!--================History Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <h4><i class="fa fa-history"></i> History</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No. Order</td>
                                <td>Status</td>
                                <td>Subtotal</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkouts as $checkout)
                            <tr>
                                <td class="align-middle">000{{ $checkout->id }}</td>
                                <td class="align-middle">
                                    @if( $checkout->status == 2)
                                    Menunggu Bukti Pembayaran
                                    @elseif( $checkout->status == 3)
                                    Memproses Bukti Pembayaran
                                    @elseif( $checkout->status == 4)
                                    Pesanan Dikirim
                                    @endif
                                </td>
                                <td class="align-middle">IDR {{ number_format($checkout->harga_total_kirim) }}</td>
                                <td><a href="{{ url('history')}}/{{ $checkout->id }}" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer"><i class="fa fa-info"></i>Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End History Area =================-->
@endsection