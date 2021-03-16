@extends('layouts.home.main')
@section('page-title', 'Login - '.config('app.name'))
@section('login-active', 'active')
@section('content')
<!-- Courses section -->
<section class="enroll-section spad pt-0 text-white set-bg" data-setbg="/home/img/auth-bg.jpg">
    <div class="container ">
        <div class="contact-form spad pb-0">
            <div class="section-title text-center">
                <h3><i class="fa fa-star orange text-shadow" aria-hidden="true"></i> LOGIN <i class="fa fa-star orange" aria-hidden="true"></i></h3>
                <p class="text-capitalize">Login to your {{ config('app.name') }} dashboard to perform operations such as wallet funding, withdrawals, trading, etc.</p>
            </div>
            <form class="comment-form --contact shadow" action="{{ route('login') }}" method="POST" style="position: relative; margin: 0 auto; width: 450px;">
                @csrf
                <div class="col-lg-12">
                  @if(session()->has('success'))
                    <div class="alert alert-success">
                      {{ session()->get('success') }}
                    </div>
                  @endif
                  @if(session()->has('failed'))
                    <div class="alert alert-danger">
                      {{ session()->get('failed') }}
                    </div>
                  @endif
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <input type="text" name="email" class="form-control" placeholder="Email Address" autofocus>
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="password"class="form-control" placeholder="Password">
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <button class="site-btn">LOGIN</button>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                      @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                          </a>
                      @endif
                    </div>
                    <div class="col-md-12 text-center">
                    <h5 class=" mt-4 mb-4">- OR -</h5>
                          <a class="site-btn" href="{{ route('register') }}">
                            {{ __("REGISTER NOW!") }}
                          </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Courses section end-->
@endsection
@section('myJS')
{{-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();

    $('.payments').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
    });

    $("#testimonial-slider").owlCarousel({
        items:2,
        itemsDesktop:[1000,2],
        itemsDesktopSmall:[979,2],
        itemsTablet:[768,1],
        pagination:true,
        autoPlay:true
    });
  </script> --}}
@endsection
