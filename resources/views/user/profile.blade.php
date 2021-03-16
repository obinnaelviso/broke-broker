@extends('layouts.user.main')
@section('title', 'Profile - '.config('app.name'))
@section('page-title', 'Profile')
@section('breadcrumb')
  	<li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-6">
      <form action="" class="row">
          <div class="col-lg-12">
            @if(session()->has('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}
              </div>
              <div class="alert alert-danger">
                {{ session()->get('failed') }}
              </div>
            @endif
          </div>

          {{-- <div class="col-md-12">
              <a class="btn btn-success" style="color: white">Apply For OTP >></a>
          </div> --}}

          <div class="col-md-12">
          	<label class="profile form-control" for="first_name"> {{ __('First Name') }} </label>
            <input type="text" class="profile form-control" id="profile" value="{{ $user->first_name }}" readonly>
          </div>
          <div class="col-md-12">
          	<label class="profile form-control" for="last_name"> {{ __('Last Name') }} </label>
            <input type="text" class="profile form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" readonly>
          </div>
          <div class="col-md-4">
          	<label class="profile form-control" for="gender"> {{ __('Gender') }} </label>
          	<input type="text" class="profile form-control" name="gender" id="gender" value="{{ ucfirst($user->gender) }}" readonly>
          </div>
          <div class="col-md-12">
          	<label class="profile form-control" for="email"> {{ __('Email Address') }} </label>
            <input type="text" class="profile form-control" name="email" id="email" placeholder="Email Address" value="{{ $user->email }}" readonly>
          </div>
          <div class="col-md-12">
          	<label class="profile form-control" for="phone"> {{ __('Phone Number') }} </label>
            <input type="text" class="profile form-control" name="phone" id="phone" value="{{ $user->phone }}" readonly>
          </div>
          <div class="col-md-12">
          	<label class="profile form-control" for="address"> {{ __('Address') }} </label>
            <input type="text" class="profile form-control mb-4" name="address" id="address" value="{{ $user->address }}, {{ ucfirst($user->country) }}" placeholder="Address" readonly>
          </div>
          <div class="col-md-12">
            <label class="profile form-control" for="transaction_pin"> {{ __('Transaction Pin') }} </label>
          <input type="text" class="profile form-control mb-4" name="transaction_pin" id="transaction_pin" value="{{ $user->transaction_pin }}" placeholder="transaction_pin" readonly>
        </div>
          <div class="col-md-12">
          	<a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
          	<a href="{{ route('user.profile.change_password') }}" class="btn btn-success">Change Password</a>
      	  </div>
        </form>
    </div>
  </div>
@endsection
