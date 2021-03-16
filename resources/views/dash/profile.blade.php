@extends('layouts.dash.main')
@section('title', 'Profile - '.config('app.name'))
@section('profile-active', 'active')
@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Profile</h2>
            {{-- <p class="pageheader-text">Fill in your account details and your withdrawal will be processed in less than an hour</p> --}}
            <hr>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-6">
        @include('layouts.dash.alerts')
      <form action="{{ route('user.profile.edit') }}" method="POST">
          @csrf
          <div class="col-md-12">
            <label for="amount" class="col-form-label">First Name</label>
            <input type="text" class="form-control mb-4" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
          </div>
          <div class="col-md-12">
            <label for="amount" class="col-form-label">Last Name</label>
            <input type="text" class="form-control mb-4" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
          </div>

          <div class="col-md-12">
            <label for="amount" class="col-form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ $user->email }}" disabled>
            <div class="alert alert-warning mb-4"> * Sorry but you can't edit your email after registration. Please contact admin! </div>
          </div>
          <div class="col-md-12">
            <label for="amount" class="col-form-label">Phone Number</label>
            <input type="text" class="form-control num mb-4" name="phone" id="telephone" placeholder="Phone Number" value="{{ $user->phone }}" required>
          </div>

          <div class="col-12">
            <button class="btn btn-primary btn-sm">Update Profile</button>
          </div>
          @if(count($errors))
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
@section('input-js')

<!-- Numeric validation -->
<script src="/plugins/numeric-validation/jquery.numeric.min.js"></script>

<script type="text/javascript">
	$(".num").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
</script>
@endsection
