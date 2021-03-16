@extends('layouts.admin.main')
@section('title', 'Default Transactions')
@section('page-title', 'Default Transactions')
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
      <button class="btn btn-primary" data-toggle="modal" data-target="#add_default_transaction">Add Default Transactions</button> @include('admin.add_default_transaction')
      <form class="form-control" id="query" method="GET" action="#">
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
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
              <tr>
                <td>{{ $transaction->initial_deposit }}</td>
                <td>{{ $transaction->profit_made }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td><button class="btn btn-danger" onclick="deleteDefaultTransaction('{{ $transaction->id }}')">Delete</button></td>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    function deleteDefaultTransaction(transaction_id) {
        var alertDelete = confirm("Are you sure you want to delete?")
        if(alertDelete == true) {
            $.ajax({
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: "/suser/default-transactions/" + transaction_id +"/delete",
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
@endsection
@section('input-js')
<script>
    jQuery('#datetimepicker').datetimepicker();
</script>
@endsection
