@extends('layouts.home.main')
@section('page-title', 'Create a New Account - '.config('app.name'))
@section('register-active', 'active')
@section('content')
<!-- Courses section -->
<section class="enroll-section spad pt-0 text-white set-bg" data-setbg="/home/img/hero-slider/2.jpg">
    <div class="container ">
        <div class="contact-form spad pb-0">
            <div class="section-title text-center">
                <h3><i class="fa fa-star orange text-shadow" aria-hidden="true"></i> REGISTER <i class="fa fa-star orange" aria-hidden="true"></i></h3>
                <p class="text-capitalize">Create a {{ config('app.name') }} account today and start earning!</p>
            </div>
            <form class="comment-form --contact shadow" action="{{ route('register') }}" method="POST" style="position: relative; margin: 0 auto; width: 450px;">
                @csrf
                <div class="row text-center">
                    <div class="col-md-12">
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="phone" id="phone" class="form-control num" placeholder="Phone Number" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                       <label>Please upload your ID (Drivers license/International Passport/National ID)</label>
                       <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-12">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype Password" required>
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
                            <button class="site-btn">REGISTER</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h5 class=" mt-4 mb-4">- OR -</h5>
                        <a class="site-btn" href="{{ route('login') }}">
                        {{ __("LOGIN TO DASHBOARD") }}
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
<!-- Numeric validation -->
<script src="/plugins/numeric-validation/jquery.numeric.min.js"></script>
<script type="text/javascript">
	$(".num").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	// $("#positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
</script>
@endsection
