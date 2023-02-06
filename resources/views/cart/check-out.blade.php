@extends('layouts.app')

@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Profile
		</h2>
	</section>	

    <!-- Content page -->
	<section class="bg0 p-t-50 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
                        <form method="POST" action="{{ url('up-profile') }}">
                            <h4 class="mtext-105 cl2 txt-center p-b-30">
                                Update Profile Information
                            </h4>
                            @csrf
                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input id="name" type="text" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input id="email" type="email" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ $user->email }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input id="number" type="text" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('number') is-invalid @enderror" name="number" value="{{ $user->no_hp }}" required autocomplete="number"
                                    placeholder="Phone Number">
                                    @error('number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="bor8 m-b-20 how-pos4-parent">
                                <input id="add1" type="text" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('add1') is-invalid @enderror" name="add1" value="{{ $user->alamat }}" required autocomplete="add1"
                                    placeholder="Address">
                                    @error('add1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                Update
                            </button>
                        </form>
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

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									Flat Rate Rp 50,000
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-20">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									Rp {{number_format($checkout->harga_total+50000)}}
								</span>
							</div>
						</div>
                        
						<span class="m-text-109 cl2">  Metode Pembayaran </span>
                        <form class="p-b-20" action="{{ url('check-out') }}" method="post">
                        @csrf
                            
                            <div class="active form-group">
                                <div class="radion_btn">
                                    <input type="radio" id="BNI" name="selector" value="BNI">
                                    <label for="BNI">BNI </label>
                                    <img src="frontend/images/icons/icon-pay-01.png" alt="ICON-PAY">
                                    <div class="check"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="radion_btn">
                                    <input type="radio" id="BRI" name="selector" value="BRI">
                                    <label for="BRI">BRI </label>
                                    <img src="frontend/images/icons/icon-pay-02.png" alt="ICON-PAY">
                                    <div class="check"></div>
                                </div>
                            </div>

							<div class="form-group">
                                <div class="radion_btn">
                                    <input type="radio" id="Dana" name="selector" value="Dana">
                                    <label for="Dana">Dana </label>
                                    <img src="frontend/images/icons/icon-pay-03.png" alt="ICON-PAY">
                                    <div class="check"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="radion_btn">
                                    <input type="radio" id="OVO" name="selector" value="OVO">
                                    <label for="OVO">OVO </label>
                                    <img src="frontend/images/icons/icon-pay-04.png" alt="ICON-PAY">
                                    <div class="check"></div>
                                </div>
                            </div>

							<div class="p-t-20">
                            	<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" value="submit" type="submit">Proceed to Purchase</button>
							</div>
                        </form>         
					</div>
				</div>
			</div>
        </div>
    </section>
@endsection