@extends('layouts.dash.main')
@section('title', 'Change Password - '.config('app.name'))
@section('password-active', 'active')
@section('content')
@include('layouts.dash.wallet')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Change Password</h2>
            {{-- <p class="pageheader-text">Fill in your account details and your withdrawal will be processed in less than an hour</p> --}}
            <hr>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        @include('layouts.dash.alerts')
      <form action="{{ route('user.profile.change_password') }}" method="POST">
          @csrf
          <div class="col-md-12">
            <input type="password" class="form-control mb-4" name="old_password" id="password" placeholder="Old Password" autofocus required>
          </div>
          <div class="col-md-12">
            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="New Password" required>
          </div>
          <div class="col-md-12">
            <input type="password" class="form-control mb-4" name="password_confirmation" id="password_confirmation" placeholder="Retype Password" required>
          </div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary btn-sm">Change Password</button>
          </div>
          @if(count($errors))
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

@endsection
