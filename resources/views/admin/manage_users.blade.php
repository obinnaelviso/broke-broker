@extends('layouts.admin.main')
@section('title', 'Manage Users')
@section('page-title', 'Manage Users')
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
              <th>Name</th>
              <th>Email</th>
              <th>Wallet</th>
              {{-- <th>Phone Number</th> --}}
              <th>Account Status</th>
              <th>Date Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td><a href="{{ route('suser.manage_user', $user->id) }}">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</a></td>
                <td>{{ $user->email }}</td>
                <td>${{ $user->wallet->amount }}</td>
                {{-- <td>{{ $user->phone }}</td> --}}
                <td>@if($user->acc_stat_id == 1)<div class="orange-text">
                    @elseif($user->acc_stat_id == 2) <div class="green-text">
                    @elseif($user->acc_stat_id == 3) <div class="red-text">
                    @endif<i>{{ $user->acc_stat->name }}</i></div></td>
                <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                <td>
                    <form method="POST" action="{{ route('suser.account_status', $user->id) }}" style="display: inline;">
                        @csrf
                        @if($user->acc_stat_id == 1)
                            <button class="btn btn-success">Activate</button>
                        @elseif($user->acc_stat_id == 2)
                            <button class="btn btn-danger">Block</button>
                        @elseif($user->acc_stat_id == 3)
                            <button class="btn btn-warning">Unblock</button>
                        @endif
                    </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $users->onEachSide(5)->links() }}</div>
      </div>
    </div>
  </div>
@endsection
