@extends('layouts.user.main')
@section('title', 'Transfer Money - '.config('app.name'))
@section('page-title', 'Tranfer Money')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-6">
      <form action="{{ route('user.transfer_money') }}" method="POST" class="row">
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
            <div class="alert alert-warning">
              <ul>
                <li><strong>*</strong> The minimum transfer amount is &#8358;{{ (integer)$withdraw_spec->min_amt }}</li>
                <li><strong>*</strong> You can only transfer &#8358;{{ (integer)$withdraw_spec->max_amt }} at a time</li>
                <li><a class="alert-link" href="{{ route('user.add_money') }}">Add Money >></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4 ml-4" name="amount" id="positive-integer" autocomplete="amount" placeholder="Enter Amount" value="{{ old('amount') }}" autofocus required>
          </div>
          <div class="col-lg-12">
            <input type="email" class="form-control mb-4 ml-4" name="email" id="email" autocomplete="email" placeholder="Receiver's Email Address" value="{{ old('email') }}" autofocus required>
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4 ml-4" name="password" id="password" autocomplete="password" placeholder="Confirm Password" autofocus required>
          </div>
          <div class="col-12 mb-4 ml-4">
            <button class="btn btn-primary">{{ __('Transfer') }}</button>
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
@endsection
