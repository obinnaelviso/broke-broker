@section('title', 'Verify Email - Royal Imperial Bank')
@section('page-title', 'Email Verification')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <strong><a href="{{ route('verification.resend') }}">{{ __('click here') }}</strong></a> to request another.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="zxx">
@include('layouts.head')
<body>
  @include('layouts.user.header')
  @include('layouts.user.body')
  @include('layouts.footer')
  @include('layouts.js')
</body>
</html>
