<section class="admin-stat">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h5 class="red-text"><span style="color: grey">Welcome</span> {{ ucfirst($suser->first_name) }} {{ ucfirst($suser->last_name) }}</h5><br><form method="POST" action="{{ route('suser.logout') }}" style="display: inline">
              @csrf
              <button class="shift-right btn btn-danger"><i class="ti-power-off"></i> Logout</button>
          </form>
        {{-- <div><em><strong>Quick Tasks: </strong><a href="{{ route('suser.transactions') }}">Transaction Summary</a>, <a href="{{ route('suser.otps') }}">Generate Otps</a>, <a href="{{ route('suser.manage_users') }}">Manage Users</a></em></div> --}}
      </div>
    </div>
  </div>
</section>
