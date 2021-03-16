@extends('layouts.admin.main')
@section('title', 'Configure nwallet - nwallet')
@section('page-title', 'Configure nwallet')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
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
      <table class="table table-borderless" id="table-borderless">
        <tbody>
          <form method="POST" action="{{ route('suser.configure_nwallet') }}">
            @csrf
            <tr><td><a class="btn btn-primary" href="{{ route('suser.configure_homepage') }}">Configure Homepage</a></td></tr>
            <th><h5>Withdraw Settings<hr></h5></th>
              <tr class="ml-4">
                <td class="bold">Minimum Amount: </td>
                <td><input type="text" class="form-control small-input num" name="with_min" value="{{ $withdraw_spec->min_amt }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Maximum Amount: </td>
                <td><input type="text" class="form-control small-input num" name="with_max" value="{{ $withdraw_spec->max_amt }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Minimum Balance: </td>
                <td><input type="text" class="form-control small-input num" name="with_bal" value="{{ $withdraw_spec->min_bal }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Charge: </td>
                <td><input type="text" class="form-control small-input num" name="with_charge" value="{{ $withdraw_spec->charge }}" required></td>
              </tr>
              {{-- Transfer Setting --}}
            <th><h5>Transfer Settings<hr></h5></th>
              <tr class="ml-4">
                <td class="bold">Minimum Amount: </td>
                <td><input type="text" class="form-control small-input num" name="trf_min" value="{{ $transfer_spec->min_amt }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Maximum Amount: </td>
                <td><input type="text" class="form-control small-input num" name="trf_max" value="{{ $transfer_spec->max_amt }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Minimum Balance: </td>
                <td><input type="text" class="form-control small-input num" name="trf_bal" value="{{ $transfer_spec->min_bal }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Charge: </td>
                <td width="50%"><input type="text" class="form-control small-input num" name="trf_charge" value="{{ $transfer_spec->charge }}" required></td>
              </tr>
            <th><h5>Customize User Popup Message<hr></h5></th>
              <tr class="ml-4">
                <td class="bold">Title:</td>
                <td><input type="text" class="form-control" name="popup_title" maxlength= 100 value="{{ $admin_msg->title }}" required></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Message: </td>
                <td><textarea type="text" class="form-control" placeholder="User Popup Message" name="popup_message" maxlength="255" rows="5" style="resize: none" required>{{ $admin_msg->message }}</textarea></td>
              </tr>
              <tr class="ml-4">
                <td class="bold">Activate: </td>
                <td><input type="checkbox" name="status" class="checkbox" value="1" @if($admin_msg->service_stat_id == 1) checked @endif></td>
              </tr>
              <tr><td><button class="btn btn-primary">Save Changes</button></td></tr>
            </form>
        </tbody>
      </table>
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
    </div>
  </div>
@endsection

@section('input-js')
  <script>
    $(".checkbox").Sswitch({
      onSwitchChange: function() {
      }
    });

  </script>
@endsection
