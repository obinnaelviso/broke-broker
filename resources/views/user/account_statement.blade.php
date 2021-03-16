@extends('layouts.user.main')
@section('title', 'Account Statement - '.config('app.name'))
@section('page-title', 'Account Statement')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	   <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              {{-- <th>#</th> --}}
              <th>Reference No.</th>
              <th>Transaction Type</th>
              <th>Amount</th>
              <th>Description</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
              <tr>
                <td>{{ strtoupper($transaction->reference_no) }}</td>
                <td>{{ $transaction->prev_bal }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ ucfirst($transaction->description) }}</td>
                <td>{{ $transaction->created_at->diffForHumans() }}</td>
                <td>
                    <div class="green-text">success</div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
