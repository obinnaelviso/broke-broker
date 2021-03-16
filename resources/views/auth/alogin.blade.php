@section('title', config('app.name').' - Admin Login')
<!DOCTYPE html>
<html lang="zxx">

@include('layouts.head')

<body>
<section class="section" style=" margin-top: 70px">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mb-4" style="text-align: center; letter-spacing: 5px"> {{ config('app.name') }} - <span class="red-text">ADMIN</span></h2>
        <form action="{{ route('suser.login') }}" method="POST" class="row" style="position: relative; margin: 0 auto; width: 450px;">
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
          <div class="col-lg-12">
            <input type="email" class="form-control mb-4" name="email" id="email" autocomplete="email" placeholder="Email Address" value="{{ old('email') }}" autofocus required>
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="col-lg-12 ml-4 mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
          </div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary">{{ __('Login') }}</button>
          </div>
          <div class="col-lg-12 text-center">
            @if (Route::has('suser.password.request'))
                <a href="{{ route('suser.password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@include('layouts.footer')

@include('layouts.js')

</body>
</html>
