@extends('layouts.admin.main')
@section('title', 'Manage OTPs')
@section('page-title', 'Manage OTPs')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row text-center">
  	<div class="col-12">
      <div class="col-lg-12">
        @if(session()->has('active'))
          <div class="alert alert-primary">
            {{ session()->get('active') }}
          </div>
        @endif
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
      <div class="col-lg-12 mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#show_generate_otp">Generate OTP</button> @include('admin.generate_otp')
      </div>
      <div class="table-responsive" id="my-otps">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>User</th>
              <th>OTP code</th>
              <th>Active</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($otps as $otp)
              <tr>
                <td>{{ ucfirst($otp->user->first_name.' '.$otp->user->last_name) }}</td>
                <td>{{ $otp->code }}</td>
                <td>
                    @if($otp->service_stat_id == 1)
                        <i class="green-text">active
                    @else
                        <i class="red-text">blocked</i>
                    @endif
                </td>
                <td>{{ $otp->created_at->diffForHumans() }}</td>
                <td><button class="btn btn-danger" onclick="deactivateOtp('{{ $otp->id }}')" @if($otp->service_stat_id == 2) disabled @endif>Deactivate</button></td>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    function deactivateOtp(id) {
        var alertDelete = confirm("Are you sure you want to deactivate otp?")
        if(alertDelete == true) {
            $.ajax({
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: "/suser/otps/" + id +"/deactivate",
                success: function(msg){
                    $("#my-otps").fadeOut(200, function(){
                            // form.html(msg).fadeIn().delay(2000);
                            $("#my-otps").hide().load(location.href + " #my-otps>*").fadeIn().delay(200);
                    }).hide()
                alert('OTPs removed successfully!')
                }
            });
        }
    }
</script>
@endsection
