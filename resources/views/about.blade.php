@extends('layouts.home.main')
@section('page-title', 'About Us - '.config('app.name'))
@section('about-active', 'active')
@section('content')

	<!-- Services section -->
	<section class="enroll-section spad set-bg" data-setbg="/home/img/enroll-bg.jpg">
		<div class="container services">
			<div class="section-title text-center">
				<h1 style="color:white; text-shadow: black 2px 2px 2px">ABOUT US</h1>
			</div>
		</div>
	</section>
	<!-- Services section end -->


	<!-- Enroll section -->
	<section class="enroll-section spad set-bg" data-setbg="/home/img/hero-slider/2.jpg">
		<div class="container">
            <div class="section-title">
                <h2 style="color:orange; text-shadow: black 2px 2px 2px">About <span style="color: white">{{ @config('app.name') }}</span></h2>
                <hr>
                <p style="font-size: 16px; color: ghostwhite">{{ @config('app.name') }} is a distinctive investment company offering our investors access to high-growth investment opportunities in Bitcoin markets and other services. We implement best practices of trading Bitcoins through our operations, while offering flexibility in our investment plans. Our company benefits from an extensive network of global clients. At Glo FX Trade, we emphasize on understanding our client’s requirement and providing suitable solutions to meet their investment criteria. Our aim is to utilize our expertise & knowledge which will benefit our clients and the users of our services. Our company believes that when a team outperforms expectations, excellence becomes a reality.
                <br> {{ @config('app.name') }} is an innovative online foreign exchange broker that offers advanced institutional and retail trading conditions to a global audience. We believe in the importance of building strong, secure foundations and the cornerstone of our mission is to provide the full spectrum of cutting-edge trading tools and services that our clients require to succeed in the world’s most liquid market.
                </p>
            </div>
		</div>
	</section>
    <!-- Enroll section end -->

	<!-- Services section -->
	<section class="enroll-section spad set-bg" data-setbg="/home/img/gallery/2.jpg">
		<div class="container services">
			<div class="section-title text-center">
				<h2 style="color:orange; text-shadow: black 2px 2px 2px">JOIN {{ config('app.name') }} today to start earning!</h2>
                <h4 class="text-white text-capitalize">Our experts are here to help you succeed, so you can hit us up on our live chat for more information.</h4>
                <a href="{{ route('register') }}" class="site-btn mt-3">Register Now!</a>
			</div>
		</div>
	</section>
	<!-- Services section end -->

@endsection
@section('myJS')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
@endsection
