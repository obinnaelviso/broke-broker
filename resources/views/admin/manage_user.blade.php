@extends('layouts.admin.main')
@section('title', 'Manage User')
@section('page-title') Manage User - {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }} @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('suser.manage_users') }}">Manage Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</li>
@endsection
@section('content')
  <div class="row">
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
      <table class="table table-striped" id="table-striped">
        <tbody>
          <tr>
            <td>Name: <strong>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</strong></td>
            <td>Balance: <strong>$<span id="my-balance">{{ $user->wallet->amount }}</span></strong> <button class="btn btn-primary" id="edit-balance">Edit Balance</button></td>
          </tr>
          <tr>
            <td>Email: <strong>{{ $user->email }}</strong></td>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#update_email">Update</button>@include('admin.update_email')</td>
          </tr>
          <tr>
            {{-- <td>Gender: <strong>{{ ucfirst($user->gender) }}</strong></td> --}}
            <td>Phone Number: <strong>{{ $user->phone }}</strong></td>
            <td>
              <form method="POST" action="{{ route('suser.account_status', $user->id) }}" style="display: inline;">
                @csrf
                @if($user->acc_stat_id == 1)
                  <button class="btn btn-success">Activate Account</button>
                @elseif($user->acc_stat_id == 2)
                  <button class="btn btn-danger">Block Account</button>
                @elseif($user->acc_stat_id == 3)
                  <button class="btn btn-primary">Unblock Account</button>
                @endif
              </form>
              <button class="btn btn-dark" id="delete-account">Delete Account</button>
            </td>
          </tr>
          {{-- <tr>
            <td>Account Number: <strong class="green-text">{{ $user->acc_no }}</strong></td>
            <td>Account Type: <strong>{{ ucfirst($user->acc_type) }}</strong></td>
          </tr>
          <tr>
            <td>Address: <strong>{{ $user->address }}</strong></td>
            <td>Country: <strong>{{ $user->country }}</strong></td>
          </tr>
          <tr>
            <td>
                OTP status: <span id="otp-status">@if($user->otp_status)<strong class="green-text"> active
                    @else<strong class="orange-text"> inactive <button class="btn btn-success" id="activate-otp">Activate OTP</button> @endif</strong></span>
            </td>
            <td>
              Account status: @if($user->acc_stat_id == 1)<strong class="orange-text">
                @elseif($user->acc_stat_id == 2) <strong class="green-text">
                @elseif($user->acc_stat_id == 3) <strong class="red-text">
                @endif{{ $user->acc_stat->name }}</strong>
            </td>
          </tr> --}}
        </tbody>
      </table>
    </div>
  </div>
  <div class="row text-center">
  	<div class="col-12">
      <button class="btn btn-primary" data-toggle="modal" data-target="#show_add_transaction">Add Transactions</button> @include('admin.show_add_transaction')
      <form class="form-control" id="query" method="GET" action="#{{-- {{ route('user.withdraw_money.history') }} --}}">
        <div class="row">
            <div class="col-6">
            </div>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered" id="my-transactions">
          <thead>
            <tr>
              <th>Initial Deposit</th>
              <th>Profit Made</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
              <tr>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->prev_bal }}</td>
                <td><button class="btn btn-danger" onclick="deleteTransaction('{{ $transaction->id }}')">Delete</button></td>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    function deleteTransaction(transaction_id) {
        var alertDelete = confirm("Are you sure you want to delete?")
        if(alertDelete == true) {
            $.ajax({
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: "/suser/transactions/" + transaction_id +"/delete",
                success: function(msg){
                    $("#my-transactions").fadeOut(200, function(){
                            // form.html(msg).fadeIn().delay(2000);
                            $("#my-transactions").hide().load(location.href + " #my-transactions").fadeIn().delay(200);
                    }).hide()
                alert('Transaction removed successfully!')
                }
            });
        }
    }
  </script>
  {{-- Account Summary --}}
  {{-- <div class="row">
    <div class="col-12">
      <div id="accordion"> --}}
        {{-- Transaction Summary --}}
        {{-- <div class="card">
          <div class="card-header">
            <h5 class="card-link" data-toggle="collapse" href="#toggleTransactions" style="cursor: pointer;">
              Transaction Summary
            </h5>
          </div>
          <div id="toggleTransactions" class="collapse show">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Reference No.</th>
                      <th>Previous Balance</th>
                      <th>Amount</th>
                      <th>Transaction Type</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $transaction)
                      <tr>
                        <td>{{ strtoupper(substr($transaction->reference_no->reference_no, 0, 12)) }}</td>
                        <td>{{ $transaction->prev_amount }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ ucfirst($transaction->trans_type->name) }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                        <td>
                          @if($transaction->service_stat->name === 'success')
                            <div class="green-text">
                          @elseif($transaction->service_stat->name === 'pending' || $transaction->service_stat->name === 'cancelled')
                            <div class="orange-text">
                          @else
                            <div class="red-text">
                          @endif {{ $transaction->service_stat->name }}</div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="shift-right">{{ $transactions->onEachSide(5)->links() }}</div>
              </div>
            </div>
          </div>
        </div> <br> --}}

        {{-- Withdraw Requests --}}
        {{-- <div class="card">
          <div class="card-header">
            <h5 class="card-link" data-toggle="collapse" href="#toggleWithdrawRequests" style="cursor: pointer;">
              Withdraw Requests
            </h5>
          </div>
          <div id="toggleWithdrawRequests" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
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
                        <td>{{ strtoupper(substr($withdraw_request->reference_no->reference_no, 0, 12)) }}</td>
                        <td>{{ $withdraw_request->amount }}</td>
                        <td>{{ $withdraw_request->acc_name }}</td>
                        <td>{{ $withdraw_request->bank_name }}</td>
                        <td>{{ $withdraw_request->acc_no }}</td>
                        <td>{{ $withdraw_request->acc_type }}</td>
                        <td>{{ $withdraw_request->created_at->toDayDateTimeString() }}</td>
                        <td>@if($withdraw_request->service_stat_id == 3) <div class="green-text"> @elseif($withdraw_request->service_stat_id == 4) <div class="red-text"> @else <div class="orange-text"> @endif<i>{{ $withdraw_request->service_stat->name }}</i></div></td>
                        <td>@if($withdraw_request->service_stat_id == 5)<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#process_request_{{ $withdraw_request->id }}">Process Request</button>
                         @else <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#process_request_{{ $withdraw_request->id }}">View</button>@endif @include('admin.show_withdraw_request')</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="shift-right">{{ $withdraw_requests->onEachSide(5)->links() }}</div>
              </div>
            </div>
          </div>
        </div> <br> --}}
      {{-- </div> --}}
    {{-- </div>
  </div> --}}


@endsection
@section('input-js')
<script>
    $('#edit-balance').click(function() {
        var amount = prompt('Enter amount', '{{ $user->wallet->amount }}')
        if(amount != null || amount !="") {
            $.ajax({
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "amount": amount
                },
                url: '{{ route('suser.edit_balance', $user->id) }}',
                success: function(msg){
                    $("#my-balance").fadeOut(200, function(){
                            // form.html(msg).fadeIn().delay(2000);
                            $("#my-balance").hide().html(msg+'.00').fadeIn().delay(200);
                    }).hide()
                alert('User balance updated successfully!')
                }
            });
        }
    })
    $('#activate-otp').click(function() {
        var activate_otp = confirm('Are you sure you want to activate OTP?')
        $('#activate-otp').prop('disabled',true);
        $('#activate-otp').html("Activating...");
        if(activate_otp) {
            $.ajax({
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ $user->id }}
                },
                url: '{{ route('suser.otps.generate') }}',
                success: function(msg){
                    $("#otp-status").fadeOut(200, function(){
                            // form.html(msg).fadeIn().delay(2000);
                            $("#otp-status").hide().load(location.href + " #otp-status *").fadeIn().delay(200);
                    }).hide()
                alert('User OTP activated successfully!')
                }
            });
        }
    })
    $('#delete-account').click(function() {
        var delete_user = confirm('Are you sure you want to permanently delete user account?')
        if(delete_user) {
            $.ajax({
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                url: '{{ route('suser.delete_user', $user->id) }}',
                success: function(msg){
                    window.location.href = '{{ route('suser.manage_users') }}'
                }
            });
        }
    })
</script>
@endsection
