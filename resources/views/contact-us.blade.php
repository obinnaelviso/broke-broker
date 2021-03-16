@extends('layouts.home.main')
@section('page-title', 'Contact Us - '.config('app.name'))
@section('contact-active', 'active')
@section('content')

	<!-- Services section -->
	<section class="enroll-section spad set-bg" data-setbg="/home/img/course/1.jpg">
		<div class="container services">
			<div class="section-title text-center">
				<h1 style="color:white; text-shadow: black 2px 2px 2px">CONTACT US</h1>
			</div>
		</div>
	</section>
	<!-- Services section end -->


	<!-- Enroll section -->
	<section class="enroll-section spad pt-0 text-white set-bg" data-setbg="/home/img/course/4.jpg">
        <div class="container ">
            <div class="contact-form spad pb-0">
                <div class="section-title text-center">
                    <h3><i class="fa fa-star orange text-shadow" aria-hidden="true"></i> LET'S HEAR FROM YOU <i class="fa fa-star orange" aria-hidden="true"></i></h3>
                    <p class="text-capitalize">Send us a message today. We'll love to hear from you!</p>
                </div>
                <form class="comment-form --contact shadow" action="{{ route('contact_us') }}" method="POST" style="position: relative; margin: 0 auto; width: 450px;">
                    @csrf
                    @include('layouts.dash.alerts')
                    <div class="row text-center">
                        <div class="col-md-12">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="subject" id="subject" class="form-control num" placeholder="Subject" value="{{ old('subject') }}" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" placeholder="Type in your message">{{ old('message') }}</textarea>
                        </div>
                        @if($errors->any())
                            <div class="col-md-12">
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                          <li style="color: darkred;">{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                      @endif
                        <div class="col-md-12">
                            <div class="text-center">
                                <button class="site-btn">SEND MESSAGE <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
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
