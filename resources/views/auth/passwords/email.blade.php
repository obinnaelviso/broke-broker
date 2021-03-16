@section('title', 'Forgot Password - '. config('app.name'))
<!DOCTYPE html>
<html lang="zxx">

    @include('layouts.head')

    <body>
      <section class="section" style=" margin-top: 70px">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="mb-4" style="text-align: center; letter-spacing: 5px">Password Reset</h2>
              <form action="{{ route('password.email') }}" method="POST" class="row" style="position: relative; margin: 0 auto; width: 450px;">
                  @csrf
                <div class="col-lg-12">
                  @if(session()->has('status'))
                    <div class="alert alert-success">
                      {{ session()->get('status') }}
                    </div>
                  @endif
                </div>
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <div class="col-8">
                  <input type="email" class="form-control mb-4" name="email" id="email" autocomplete="email" placeholder="Email Address" autofocus value="{{ old('email') }}"
                   required>
                </div>
                <div class="col-4 mb-4">
                  <button class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
                <div class="col-lg-12 text-center">
                      <a href="{{ route('login') }}" class="btn btn-dark">{{ __('<< Go back to Login Page') }}</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

    {{-- @include('layouts.footer') --}}

    @include('layouts.js')

    </body>
</html>
