<section class="hero-section">
  <div class="container">
    <div class="row">
        <div class="col-12">
            <h5 style="color: gray;">Welcome <strong style="color: black">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</strong></h5>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 text-center">
        <div class="wallet">
          <div><strong style="color: darkgrey; font-size: 15px">YOUR BALANCE</strong></div>
          <div class="balance">&#8358;{{ $wallet->amount }}</div>
          <div>ACC. NO: <strong class="green-text" style="font-size: 22px" id="acc-no">{{ $user->acc_no }}</strong></div>
          <div>ACC. TYPE: <strong>{{ $user->acc_type }}</strong></div><br>
          <button class="btn btn-danger" id="show-acc-no">Show Account Number</button>
        </div>
          {{-- <a class="btn btn-primary" href="{{ route('user.profile') }}"><i class="ti-user"></i>Profile</a> --}}
          {{-- <form method="POST" action="{{ route('logout') }}" style="display: inline"> --}}
              {{-- @csrf --}}
              {{-- <button class="btn btn-danger"><i class="ti-power-off"></i> Logout</button> <br> --}}
          {{-- </form> --}}
          {{-- <a class="btn btn-success" href="{{ route('user.account_statement') }}"><i class="ti-notepad"></i> Account Statement</a> --}}
      </div>
      <div class="col-md-6">
          <a href="#"><div class="wallet" style="background-image: url('{{ config('globals.path') }}/storage/{!! $section3a->img !!}'); background-size: contain; height: 100%; background-repeat: no-repeat; background-color: white"></div></a>
      </div>
    </div>
  </div>
</section>
