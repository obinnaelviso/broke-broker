@extends('layouts.admin.main')
@section('title')
  {{ ucfirst($pc_type->name) }} Promo Codes - nwallet
@endsection
@section('page-title')
  {{ ucfirst($pc_type->name) }} Promo Codes
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('suser.manage_pc') }}">Manage Promo Codes</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
  	<div class="col-12">
      <h5>Promo Codes</h5> <hr>
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
      <form class="form-control" id="query" method="GET" action="#{{-- {{ route('user.withdraw_money.history') }} --}}">
        <div class="row">
            <div class="col-6">
            </div>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Code</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Expiry Date</th>
              <th>Date Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($promo_codes as $promo_code)
              <tr>
                <td>{{ $promo_code->code }}</td>
                <td>{{ $promo_code->amount }}</a></td>
                <td>
                  @if($promo_code->service_stat->name === 'active' ||
                      $promo_code->service_stat->name === 'registration')
                    <div class="green-text">
                  @elseif($promo_code->service_stat->name === 'disabled')
                    <div class="red-text">
                  @else
                    <div class="orange-text">
                  @endif {{ $promo_code->service_stat->name }}</div>
                </td>
                <td>@if($promo_code->expire_at){{ $promo_code->expire_at->toDayDateTimeString() }} @else unlimited @endif</td>
                <td>{{ $promo_code->created_at->toDayDateTimeString() }}</td>
                <td>
                  @if($promo_code->service_stat_id != 8)
                    <button class="btn btn-primary" data-toggle="modal" data-target="#assign_pc_{{ $promo_code->id }}">Assign Code</button>@include('admin.assign_pc') @endif
                  <form method="POST" action="{{ route('suser.disable_pc', [$pc_type->id, $promo_code->id]) }}" style="display: inline;">
                      @csrf
                      @if($promo_code->service_stat_id == 1 ||
                          $promo_code->service_stat_id == 10)
                        <button class="btn btn-danger">Disable</button>
                      @elseif($promo_code->service_stat_id == 8)
                        <button class="btn btn-success">Enable</button>
                      @endif
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $promo_codes->onEachSide(5)->links() }}</div>
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12">
      <h5>Add New Promo Code</h5> <hr>
      <form action="{{ route('suser.promo_codes', $pc_type->id) }}" method="POST" class="col-md-6">
          @csrf
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="code" id="code" maxlength="100" value="{{ old('code') }}" placeholder="Promo Code [leave empty to auto-generate code]">
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="amount" id="positive-integer" value="{{ old('amount') }}" placeholder="Amount">
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="expire_at" id="datetimepicker" value="{{ old('expire_at') }}" placeholder="Expiry Date [Leave empty if it does not expire]" readonly>
          </div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary btn-sm">ADD PROMO CODE</button>
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
  <div class="col-12">
      <h5>Assigned Promo Codes</h5> <hr>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>User</th>
              <th>Code</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($assigned_pcs as $assigned_pc)
              <tr>
                <td><a href="{{ route('suser.manage_user', $assigned_pc->user->id) }}#togglePromoCodes">{{ ucfirst($assigned_pc->user->first_name) }} {{ ucfirst($assigned_pc->user->last_name) }}</a></td>
                <td>{{ $assigned_pc->promo_code->code }}</td>
                <td>{{ $assigned_pc->promo_code->amount }}</a></td>
                <td>
                  @if($assigned_pc->service_stat->name === 'active')
                    <div class="green-text">
                  @else
                    <div class="orange-text">
                  @endif {{ $assigned_pc->service_stat->name }}</div>
                <td>
                  <form method="POST" action="{{ route('suser.remove_pc', [$pc_type->id, $assigned_pc->id]) }}">
                      @csrf
                    <button class="btn btn-danger">Remove</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $assigned_pcs->onEachSide(5)->links() }}</div>
      </div>
    </div>
@endsection

@section('input-js')
  <script>
    jQuery('#datetimepicker').datetimepicker();
  </script>
@endsection