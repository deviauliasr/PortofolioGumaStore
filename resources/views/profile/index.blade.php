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
			<div class="flex-w flex-tr">
                <div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<h4 class="mtext-105 cl2 txt-center p-b-30">
						Your Profile Information
					</h4>
                    <div class="flex-w w-full p-b-30">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-user"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Nama
							</span>

							<p class="stext-115 cl1 size-213">
                                {{ $user->name }}
							</p>
						</div>
					</div>
                    
                    <div class="flex-w w-full p-b-30">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Email
							</span>

							<p class="stext-115 cl1 size-213">
                                {{ $user->email }}
							</p>
						</div>
					</div>

                    <div class="flex-w w-full p-b-30">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Nomor Telepon
							</span>

							<p class="stext-115 cl1 size-213">
                                {{ $user->no_hp }}
                            @empty($user->no_hp) 
                                None
                            @endif
							</p>
						</div>
					</div>

                    <div class="flex-w w-full p-b-30">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Alamat
							</span>

							<p class="stext-115 cl1 size-213">
                                {{ $user->alamat }}
                            @empty($user->alamat) 
                                None
                            @endif
							</p>
						</div>
					</div>
                </div>
                <div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="POST" action="{{ url('profile') }}">
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

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input id="password" type="password" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>

                        <div class="bor8 m-b-20 how-pos4-parent">
							<input id="password-confirm" type="password" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
						</div>

						<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Update
						</button>
					</form>
				</div>
            </div>
        </div>
    </section>
@endsection
