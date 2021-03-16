@extends('layouts.user.main')
@section('title', 'Add Money - '.config('app.name'))
@section('page-title', 'Add Money')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-6">
      <form action="{{ route('user.pay') }}" method="POST" class="row">
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
            <input type="text" class="form-control mb-4 ml-4" name="amount" id="positive-integer" autocomplete="amount" placeholder="Enter Amount" value="{{ old('amount') }}" autofocus required>
          </div>
          <div class="col-12 mb-4 ml-4">
            <button class="btn btn-primary">{{ __('Proceed to payment') }}</button> &nbsp;
            <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/paystack.png" style="width: 50px">
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
