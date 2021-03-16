@extends('layouts.admin.main')
@section('title', 'Withdraw Requests - nwallet')
@section('page-title', 'Withdraw Requests')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row text-center">
  	<div class="col-12">
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
        <table class="table table-striped">
          <thead>
            <tr>
              <th>User</th>
              <th>Reference No.</th>
              <th>Amount</th>
              <th>Account Name</th>
              <th>Bank</th> 
              <th>Account No.</th> 
              <th>Account Type</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($withdraw_requests as $withdraw_request)
              <tr>
                <td><a href="{{ route('suser.manage_user', $withdraw_request->user->id) }}#toggleWithdrawRequests">{{ ucfirst($withdraw_request->user->first_name) }} {{ ucfirst($withdraw_request->user->last_name) }}</a></td>
                <td>{{ strtoupper(substr($withdraw_request->reference_no->reference_no, 0, 12)) }}</td>
                <td>{{ $withdraw_request->amount }}</td>
                <td>{{ $withdraw_request->acc_name }}</td>
                <td>{{ $withdraw_request->bank_name }}</td>
                <td>{{ $withdraw_request->acc_no }}</td>
                <td>{{ $withdraw_request->acc_type }}</td>
                <td>{{ $withdraw_request->created_at->toDayDateTimeString() }}</td>
                <td>@if($withdraw_request->service_stat_id == 3) <div class="green-text"> @elseif($withdraw_request->service_stat_id == 4) <div class="red-text"> @else <div class="orange-text"> @endif<i>{{ $withdraw_request->service_stat->name }}</i></div></td>
                <td>@if($withdraw_request->service_stat_id == 5)<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#process_request_{{ $withdraw_request->id }}">Process Request</button>
                @include('admin.show_withdraw_request') @else <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#process_request_{{ $withdraw_request->id }}">View</button>
                @include('admin.show_withdraw_request') @endif</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $withdraw_requests->onEachSide(5)->links() }}</div>
      </div>
    </div>
  </div>
@endsection