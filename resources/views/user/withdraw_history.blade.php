@extends('layouts.user.main')
@section('title', 'Withdrawal History - '.config('app.name'))
@section('page-title', 'Withdrawal History')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.withdraw_money') }}">Withdraw Money</a></li>
	   <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <form class="form-control" id="query" method="GET" action="{{ route('user.withdraw_money.history') }}">
        <div class="row">
            <div class="col-6 col-md-3">
              <select class="form-control" id="filter" name="filter" onchange="query()">
                  <option value="all" @if($filter === 'all') selected @endif>Filter: Show All</option>
                  <option value="debit" @if($filter === 'success') selected @endif>Filter: Success</option>
                  <option value="debit" @if($filter === 'failed') selected @endif>Filter: Failed</option>
                  <option value="credit" @if($filter === 'pending') selected @endif>Filter: Pending</option>
                  <option value="transfer" @if($filter === 'in_progress') selected @endif>Filter: In-Progress</option>
                  <option value="withdraw" @if($filter === 'cancelled') selected @endif>Filter: Cancelled</option>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <select class="form-control" id="sort" name="sort" onchange="query()">
                  <option value="newest" @if($sort === 'newest') selected @endif>Sort By: Newest</option>
                  <option value="oldest" @if($sort === 'oldest') selected @endif>Sort By: Oldest</option>
              </select>
            </div>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Reference No.</th>
              <th>Amount</th>
              <th>Charge</th>
              <th>Details</th>
              <th>Account Name</th>
              <th>Bank</th>
              <th>Account No.</th>
              <th>Account Type</th>
              <th>Date</th>
              <th>Expiry Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($withdraw_requests as $withdraw_request)
              <form action="{{ route('user.withdraw_money.cancel', $withdraw_request->id) }}" method="POST">
                  @csrf
                <tr>
                  <td>{{ strtoupper(substr($withdraw_request->reference_no->reference_no, 0, 12)) }}</td>
                  <td>{{ $withdraw_request->amount }}</td>
                  <td>{{ $withdraw_request->charge }}</td>
                  <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ $withdraw_request->message }}">{{ substr($withdraw_request->message, 0, 25) }}...</a></td>
                  <td>{{ $withdraw_request->acc_name }}</td>
                  <td>{{ $withdraw_request->bank_name }}</td>
                  <td>{{ $withdraw_request->acc_no }}</td>
                  <td>{{ $withdraw_request->acc_type }}</td>
                  <td>{{ $withdraw_request->created_at->toFormattedDateString() }}</td>
                  <td>{{ $withdraw_request->expire_at->toFormattedDateString() }}</td>
                  <td>@if($withdraw_request->service_stat_id == 3) <div class="green-text"> @elseif($withdraw_request->service_stat_id == 4) <div class="red-text"> @else <div class="orange-text"> @endif<i>{{ $withdraw_request->service_stat->name }}</i></div></td>
                  <td>@if($withdraw_request->service_stat_id == 5)<button class="btn btn-primary">Cancel</button>@endif</td>
                </tr>
              </form>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
