@extends('layouts.user.main')
@section('title', 'Redeem Promo Code - '.config('app.name'))
@section('page-title', 'Redeem Promo Code')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	   <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-12 col-md-6">
      <h5>Promo Codes</h5><hr>
      @if(!$promo_codes->count())
        <div class="alert alert-info">
            The are no promo codes available for you!
          </div>
      @else
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Promo Code</th>
                <th>Status</th>
                <th>Issued Date</th>
                <th>Expiry Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($promo_codes as $promo_code)
                <tr>
                  <td>{{ $promo_code->promo_code->code }}</td>
                  <td>
                    @if($promo_code->service_stat->name === 'active')
                      <div class="green-text">
                    @elseif($promo_code->service_stat->name === 'disabled')
                      <div class="red-text">
                    @else
                      <div class="orange-text">
                    @endif {{ $promo_code->service_stat->name }}</div>
                  </td>
                  <td>{{ $promo_code->promo_code->created_at->toDayDateTimeString() }}</td>
                  <td>@if($promo_code->expire_at){{ $promo_code->promo_code->expire_at->toDayDateTimeString() }} @else unlimited @endif</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h5>Redeem Code</h5> <hr>
      <div class="col-12 col-md-6">
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
      <form action="{{ route('user.pc_check') }}" method="POST" class="col-md-6">
          @csrf
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="code" id="code" maxlength="100" value="{{ old('code') }}" placeholder="Enter Promo Code" autofocus>
          </div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary btn-sm">Redeem</button>
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
