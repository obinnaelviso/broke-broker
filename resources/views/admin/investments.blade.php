@extends('layouts.admin.main')
@section('title', 'Manage Investments')
@section('page-title', 'Manage Investments')
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
      {{-- <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_investment_plan">Add Investments</button> --}}
      <div class="table-responsive">
        <table class="table table-bordered" id="investments">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Title</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Profit per Cycle</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Completed Cycles</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($active_investments as $investment)
                    @php
                        $profit_per_cycle = ($investment->amount * $investment->plan->percentage)/100;
                    @endphp
                    <tr>
                        <td>{{ $investment->user->first_name.' '.$investment->user->last_name }}</td>
                        <td>{{ $investment->plan->title }}</td>
                        <td>${{  $investment->amount  }}</td>
                        <td class="text-success">${{ $profit_per_cycle }}+</td>
                        <td>{{ $investment->plan->duration }}</td>
                        <td>{{ $investment->completed_cycles.'/'.$investment->plan->cycles }}</td>
                        <td>{{ $investment->created_at->toFormattedDateString() }}</td>
                        <td>{{ $investment->expire_at->toFormattedDateString() }}</td>
                        <td>
                            <button class="btn btn-primary" onclick="cancelInvestment('{{ $investment->id }}')">Cancel</button>
                            <button class="btn btn-success" onclick="completeInvestment('{{ $investment->id }}')"><i class="fa fa-check" aria-hidden="true"></i> Complete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@push('more-js')
<script>
    function cancelInvestment(investment_id) {
        var alertDelete = confirm("Are you sure you want to cancel this investment?")
        if(alertDelete == true) {
            $.ajax({
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: "/suser/investments/"+investment_id+"/cancel",
                success: function(msg){
                    $("#investments").fadeOut(200, function(){
                            $("#investments").hide().load(location.href + " #investments").fadeIn().delay(200);
                    }).hide()
                alert('Investment cancelled successfully!')
                }
            });
        }
    }
    function completeInvestment(investment_id) {
        var alertDelete = confirm("Are you sure you want to mark this investment as complete?")
        if(alertDelete == true) {
            $.ajax({
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: "/suser/investments/"+investment_id+"/complete",
                success: function(msg){
                    $("#investments").fadeOut(200, function(){
                            $("#investments").hide().load(location.href + " #investments").fadeIn().delay(200);
                    }).hide()
                alert('Investment marked as complete successfully!')
                }
            });
        }
    }
</script>
@endpush
