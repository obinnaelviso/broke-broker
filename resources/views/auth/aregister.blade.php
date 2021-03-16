@section('title', config('app.name').' - Register Admin')
<!DOCTYPE html>
<html lang="zxx">

@include('layouts.head')

<body>
<section class="section" style=" margin-top: 70px">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mb-4" style="text-align: center; letter-spacing: 5px">{{ config('app.name') }} - Register Admin</h2>
        <form action="{{ route('suser.register') }}" method="POST" class="row" style="position: relative; margin: 0 auto; width: 552px;">
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
          <div class="col-lg-2">
            <input type="text" class="form-control mb-4" value="+234" readonly>
          </div>
          <div class="col-lg-8">
            <input type="text" class="form-control mb-4" maxlength="11" pattern="\d{11}" name="phone" id="positive-integer" value="{{ old('phone') }}" placeholder="Phone number e.g 08012345678" required>
          </div>
          <div class="col-lg-7">
            <input type="text" class="form-control mb-4" name="address" id="address" value="{{ old('address') }}" placeholder="Address" required>
          </div>
          <div class="col-lg-5">
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
            <button class="btn btn-primary btn-sm">REGISTER</button>
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
  </div>
</section>

@include('layouts.footer')

@include('layouts.js')

</body>
</html>
