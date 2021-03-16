@extends('layouts.admin.main')
@section('title', 'Manage Admins - nwallet')
@section('page-title', 'Manage Admins')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-12">
      <div class="shift-right"><a href="{{ route('suser.change_password') }}" class="btn btn-primary">Change Password</a> <a href="{{ route('suser.edit_profile') }}" class="btn btn-success">Edit Profile</a></div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12">
      <h5> Registered Administrators</h5> <hr>
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
              <th>Gender</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Account Status</th> 
              <th>Date Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($susers as $suser)
              <tr>
                <td>{{ ucfirst($suser->first_name) }} {{ ucfirst($suser->last_name) }}</td>
                <td>{{ $suser->email }}</td>
                <td>{{ ucfirst($suser->gender) }}</td>
                <td>{{ $suser->phone }}</td>
                <td>{{ $suser->address }}, {{ $suser->state }}</td>
                <td>@if($suser->acc_stat_id == 2)<div class="green-text"> @else <div class="orange-text"> @endif<i>{{ $suser->acc_stat->name }}</i></div></td>
                <td>{{ $suser->created_at->toDayDateTimeString() }}</td>
                <td>
                  <form method="POST" action="{{ route('suser.saccount_status', $suser->id) }}" style="display: inline;">
                      @csrf
                      @if($suser->acc_stat_id == 2)
                        <button class="btn btn-danger">Block</button>
                      @elseif($suser->acc_stat_id == 3)
                        <button class="btn btn-success">Unblock</button>
                      @endif
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="shift-right">{{ $susers->onEachSide(5)->links() }}</div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <h5> Register New Admin</h5> <hr>
      <form action="{{ route('suser.register') }}" method="POST" class="col-md-6">
          @csrf
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
          </div>
          <div class="col-lg-6">
            <select class="form-control mb-4" id="gender" name="gender" required>
              <option value="" disabled selected>Select Gender</option>
              <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
              <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
            </select>
          </div>
          <div class="col-lg-12">
            <input type="email" class="form-control mb-4" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" required>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control mb-4" maxlength="11" pattern="\d{11}" name="phone" id="positive-integer" value="{{ old('phone') }}" placeholder="Phone number e.g 08012345678" required>
          </div>
          <div class="col-md-7">
            <input type="text" class="form-control mb-4" name="address" id="address" value="{{ old('address') }}" placeholder="Address" required>
          </div>
          <div class="col-md-5">
            <select style="cursor: pointer;" class="form-control mb-4" id="state" name="state" required>
              <option value="" disabled selected> Select State</option>
              <option name="state" value="Abuja FCT" @if(old('state') === 'Abuja FCT') selected @endif>Abuja FCT</option>
              <option name="state" value="Abia" @if(old('state') === 'Abia') selected @endif>Abia</option>
              <option name="state" value="Adamawa" @if(old('state') === 'Adamawa') selected @endif>Adamawa</option>
              <option name="state" value="Akwa Ibom" @if(old('state') === 'Akwa Ibom') selected @endif>Akwa Ibom</option>
              <option name="state" value="Anambra" @if(old('state') === 'Anambra') selected @endif>Anambra</option>
              <option name="state" value="Bauchi" @if(old('state') === 'Bauchi') selected @endif>Bauchi</option>
              <option name="state" value="Bayelsa" @if(old('state') === 'Bayelsa') selected @endif>Bayelsa</option>
              <option name="state" value="Benue" @if(old('state') === 'Benue') selected @endif>Benue</option>
              <option name="state" value="Borno" @if(old('state') === 'Borno') selected @endif>Borno</option>
              <option name="state" value="Cross River" @if(old('state') === 'Cross River') selected @endif>Cross River</option>
              <option name="state" value="Delta" @if(old('state') === 'Delta') selected @endif>Delta</option>
              <option name="state" value="Ebonyi" @if(old('state') === 'Ebonyi') selected @endif>Ebonyi</option>
              <option name="state" value="Edo" @if(old('state') === 'Edo') selected @endif>Edo</option>
              <option name="state" value="Ekiti" @if(old('state') === 'Ekiti') selected @endif>Ekiti</option>
              <option name="state" value="Enugu" @if(old('state') === 'Enugu') selected @endif>Enugu</option>
              <option name="state" value="Gombe" @if(old('state') === 'Gombe') selected @endif>Gombe</option>
              <option name="state" value="Imo" @if(old('state') === 'Imo') selected @endif>Imo</option>
              <option name="state" value="Jigawa" @if(old('state') === 'Jigawa') selected @endif>Jigawa</option>
              <option name="state" value="Kaduna" @if(old('state') === 'Kaduna') selected @endif>Kaduna</option>
              <option name="state" value="Kano" @if(old('state') === 'Kano') selected @endif>Kano</option>
              <option name="state" value="Katsina" @if(old('state') === 'Katsina') selected @endif>Katsina</option>
              <option name="state" value="Kebbi" @if(old('state') === 'Kebbi') selected @endif>Kebbi</option>
              <option name="state" value="Kogi" @if(old('state') === 'Kogi') selected @endif>Kogi</option>
              <option name="state" value="Kwara" @if(old('state') === 'Kwara') selected @endif>Kwara</option>
              <option name="state" value="Lagos" @if(old('state') === 'Lagos') selected @endif>Lagos</option>
              <option name="state" value="Nassarawa" @if(old('state') === 'Nassarawa') selected @endif>Nassarawa</option>
              <option name="state" value="Niger" @if(old('state') === 'Niger') selected @endif>Niger</option>
              <option name="state" value="Ogun" @if(old('state') === 'Ogun') selected @endif>Ogun</option>
              <option name="state" value="Ondo" @if(old('state') === 'Ondo') selected @endif>Ondo</option>
              <option name="state" value="Osun" @if(old('state') === 'Osun') selected @endif>Osun</option>
              <option name="state" value="Oyo" @if(old('state') === 'Oyo') selected @endif>Oyo</option>
              <option name="state" value="Plateau" @if(old('state') === 'Plateau') selected @endif>Plateau</option>
              <option name="state" value="Rivers" @if(old('state') === 'Rivers') selected @endif>Rivers</option>
              <option name="state" value="Sokoto" @if(old('state') === 'Sokoto') selected @endif>Sokoto</option>
              <option name="state" value="Taraba" @if(old('state') === 'Taraba') selected @endif>Taraba</option>
              <option name="state" value="Yobo" @if(old('state') === 'Yobo') selected @endif>Yobo</option>
              <option name="state" value="Zamfara" @if(old('state') === 'Zamfara') selected @endif>Zamfara</option>
            </select>
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4" name="password_confirmation" id="password_confirmation" placeholder="Retype Password" required>
          </div>
          <div class="col-12 mb-4">
            <input type="submit" class="btn btn-primary btn-sm" name="submit" value="REGISTER">
          </div>
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
      </form>
    </div>
  </div>
@endsection