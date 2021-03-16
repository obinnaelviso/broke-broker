  <!-- preloader -->
  <div class="preloader">
    <div class="loader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- /preloader -->

<header class="navigation">
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="{{ route('user.home') }}"><img class="img-fluid" src="{{ config('globals.path') }}/images/logo.png" alt="parsa"></a>
  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navogation"
    aria-controls="navogation" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse text-center" id="navogation">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="btn btn-success" href="{{ route('user.account_statement') }}">Account Statement</a>
        </li>
      <li class="nav-item">
        <a class="nav-link text-uppercase text-orange" href="{{ route('user.withdraw_money') }}">Transfer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-uppercase text-orange" href="{{ route('user.profile') }}">Profile</a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}" style="display: inline">
          @csrf
          <button class="btn btn-danger"><i class="ti-power-off"></i> Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>
</header>
