@extends('layouts.admin.main')
@section('title', 'Home - '.config('app.name'))
@section('page-title', 'Home')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row text-center">
  	{{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/transaction-summary.png">
      <a href="{{ route('suser.transactions') }}" class="btn btn-success">Add Individual Transactions</a>
    </div> --}}
    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
        <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/configure-nwallet.png">
        <a href="{{ route('suser.default-transactions') }}" class="btn btn-success">Add Default Transactions</a>
    </div> --}}
  	{{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/withdraw-requests.png">
      <a href="{{ route('suser.withdraw_requests') }}" class="btn btn-primary">Withdraw Requests</a>
    </div> --}}
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/manage-users.png">
      <a href="{{ route('suser.manage_users') }}" class="btn btn-primary">Manage Users</a>
    </div>
    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/mail.png">
      <a href="{{ route('suser.otps') }}" class="btn btn-primary">Generate OTP</a>
    </div> --}}
    <div class="col-lg-3 col-md-4 col-sm-6">
        <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/configure-nwallet.png">
        <a href="{{ route('suser.configure_homepage') }}" class="btn btn-primary">Edit Website</a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/manage-admin.png">
      <a href="{{ route('suser.manage_admin') }}" class="btn btn-primary">Manage Admin</a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/promo-code.png">
      <a href="{{ route('suser.investments.plans') }}" class="btn btn-primary">Manage Investment Plans</a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/promo-code.png">
      <a href="{{ route('suser.investments') }}" class="btn btn-primary">Manage Investments</a>
    </div>
    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/mail.png">
      <a href="{{ route('suser.mailings') }}" class="btn btn-primary">Mailings</a>
    </div> --}}
  </div>
@endsection
