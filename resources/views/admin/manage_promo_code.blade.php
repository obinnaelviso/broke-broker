@extends('layouts.admin.main')
@section('title', 'Manage Promo Code - nwallet')
@section('page-title', 'Manage Promo Code')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
  	<div class="col-12">
      <h5>Promo Code Groups</h5> <hr>
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
              <th>Admin</th>
              <th>Name</th>
              <th>Promo codes</th>
              <th>Status</th>
              <th>Expiry Date</th>
              <th>Date Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pc_types as $pc_type)
              <tr>
                <td>{{ ucfirst($pc_type->admin->first_name) }} {{ ucfirst($pc_type->admin->last_name) }}</td>
                <td><a href="{{ route('suser.promo_codes', $pc_type->id) }}">{{ ucfirst($pc_type->name) }}</a></td>
                <td>{{ $pc_type->promo_codes->count() }}</td>
                <td>
                  @if($pc_type->service_stat->name === 'active')
                    <div class="green-text">
                  @elseif($pc_type->service_stat->name === 'disabled')
                    <div class="red-text">
                  @else
                    <div class="orange-text">
                  @endif {{ $pc_type->service_stat->name }}</div>
                </td>
                <td>@if($pc_type->expire_at){{ $pc_type->expire_at->toDayDateTimeString() }} @else unlimited @endif</td>
                <td>{{ $pc_type->created_at->toDayDateTimeString() }}</td>
                <td>
                  <form method="POST" action="{{ route('suser.disable_group', $pc_type->id) }}" style="display: inline;">
                      @csrf
                      @if($pc_type->service_stat_id == 1)
                        <button class="btn btn-danger">Disable</button>
                      @elseif($pc_type->service_stat_id == 8)
                        <button class="btn btn-success">Enable</button>
                      @endif
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $pc_types->onEachSide(5)->links() }}</div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h5> Create New Group</h5> <hr>
      <form action="{{ route('suser.manage_pc') }}" method="POST" class="col-md-6">
          @csrf
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="name" id="name" maxlength="20" value="{{ old('name') }}" placeholder="Group Name" required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="expire_at" id="datetimepicker" value="{{ old('expire_at') }}" placeholder="Expiry Date [Leave empty if it does not expire]" readonly>
          </div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary btn-sm">ADD GROUP</button>
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

@section('input-js')
  <script>
    jQuery('#datetimepicker').datetimepicker();
  </script>
@endsection