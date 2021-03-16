@section('title', 'Login - Royal Imperial Bank')
<!DOCTYPE html>
<html lang="zxx">

@include('layouts.head')

<body>
  <section class="section" style=" margin-top: 70px">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="mb-4" style="text-align: center; letter-spacing: 5px">Royal Imperial Bank - LOGIN</h2>
          <form action="{{ route('login') }}" method="POST" class="row" style="position: relative; margin: 0 auto; width: 450px;">
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
              <input type="text" class="form-control mb-4 num" name="acc_no" id="acc_no" autocomplete="acc_no" placeholder="Account Number" autofocus value="{{ old('email') }}"
               required>
            </div>
            <div class="col-lg-12">
              <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Password">
            </div>
            <div class="col-lg-12 ml-4 mb-4">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
            </div>
            <div class="col-12 mb-4">
              <button class="btn btn-primary">{{ __('Login') }}</button>
            </div>
            <div class="col-lg-12 text-center">
              @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
              @endif
            </div>
            <div class="col-lg-12 text-center">
                  <a class="btn btn-success" href="{{ route('register') }}">
                    {{ __("Haven't registered yet? Click to register!") }}
                  </a>
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
