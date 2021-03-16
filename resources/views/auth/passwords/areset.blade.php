@section('title', 'Reset Password - Royal Imperial Bank')
<!DOCTYPE html>
<html lang="zxx">

@include('layouts.head')

<body>
  <section class="section" style=" margin-top: 70px">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="mb-4" style="text-align: center; letter-spacing: 5px">Reset Password</h2>
          <form action="{{ route('suser.password.update') }}" method="POST" class="row" style="position: relative; margin: 0 auto; width: 450px;">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
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
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="col-lg-12">
              <input type="email" class="form-control mb-4" name="email" id="email" autocomplete="email" placeholder="Email Address" autofocus value="{{ $email ?? old('email') }}"
               required>
            </div>
            <div class="col-lg-12">
              <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="col-lg-12">
              <input type="password" class="form-control mb-4" name="password_confirmation" id="password" placeholder="Retype Password" required>
            </div>
            <div class="col-12 mb-4">
              <button class="btn btn-primary">{{ __('Reset Password') }}</button>
            </div>
            @if($errors->any())
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </section>

@include('layouts.footer')

@include('layouts.js')

</body>
</html>
