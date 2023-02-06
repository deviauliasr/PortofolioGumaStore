@extends('layouts.app')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Register
		</h2>
	</section>	

    <!-- Content page -->
	<section class="bg0 p-t-50 p-b-50">
		<div class="container">
			<div class="flex-w flex-tr">
                <div class="size-210 p-tb-50">
					<div class="bg-img1 txt-center p-tb-175" style="background-image: url('frontend/images/blog-01.jpg');">
						<h4 class="ltext-105 cl0 p-lr-50 txt-center"></h4>
						<a class="<block1-txt-child2 p-b-4 trans-04 c10">
							<div class="flex-c-m m-all-20 stext-101 cl0 size-114">
						    </div>
						</a>
					</div>
				</div>
				<div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="POST" action="{{ route('register') }}">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Register
						</h4>
                        @csrf
						<div class="bor8 m-b-20 how-pos4-parent">
                            <input id="name" type="text" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

						<div class="bor8 m-b-20 how-pos4-parent">
                            <input id="email" type="email" class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30 @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
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
							Register
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>	
@endsection
