@extends('layouts.admin.main')
@section('title', 'Change Password - Royal Imperial Bank')
@section('page-title', 'Change Password')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('suser.manage_admin') }}">Manage Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-md-6">
      <form action="{{ route('suser.change_password') }}" method="POST" class="row">
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
          <div class="col-12">
            @if(session()->has('error'))
              <div class="alert alert-danger">
                {{ session()->get('error') }}
              </div>
            @endif
          </div>
      </form>
    </div>
  </div>
@endsection
