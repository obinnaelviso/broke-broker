@extends('layouts.user.main')
@section('title', 'Home - '.config('app.name'))
@section('page-title', 'Home')
@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection
@section('content'){{--
  <div class="row text-center">
    <div class="col-12">
      @if($pc_count)<label class="alert alert-info"> You have {{ $pc_count }} promo code. <a class="text text-info" href="{{ route('user.redeem_pc') }}">Click to Redeem</a></label>@endif
    </div>
  </div> --}}
  <div class="row text-center">
    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/credit-wallet.png"><br>
      <a href="{{ route('user.add_money') }}" class="btn btn-success">Add money</a>
    </div> --}}
    {{-- <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/transfer.png"><br>
      <a href="{{ route('user.transfer_money') }}" class="btn btn-primary">Transfer money</a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
      <img class="img-fluid" src="{{ config('globals.path') }}/images/icons/withdraw.png"><br>
      <a href="{{ route('user.withdraw_money') }}" class="btn btn-primary">Withdraw money</a>
    </div> --}}
    <a href="#test-popup" class="mfp-hide" id="inline-popups" data-effect="mfp-zoom-in">popup</a><br>
    <div id="test-popup" class="white-popup mfp-with-anim mfp-hide"><h5>{{ $admin_msg->title }}</h5>{{ $admin_msg->message }}</div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <h5 class="mb-4 alert alert-light">Last 5 transactions</h5>
      <div class="table-responsive">
        <table class="table table-striped">
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
        <a class="btn btn-light" href="{{ route('user.account_statement') }}" style="width: 100%">View All Transactions</a>
      </div>
    </div>
  </div>
@endsection
@section('input-js')
  <script>
    @if(Session::has('popup') && ($admin_msg->service_stat_id == 1))
      $(document).ready(function() {
        $(function() {
          $('#inline-popups').click();
        });
      });
    @endif
  </script>
@endsection
