<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item ">
                        <a class="nav-link @yield('home-active')" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('trade-active')" href="{{ route('user.trade') }}">Trade</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('fund-active')" href="{{ route('user.fund_wallet') }}">Deposit</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('withdraw-active')" href="{{ url('/user/withdraw') }}">Withdraw Funds</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('investment-plans-active')" href="{{ route('user.investments.plans') }}">Investments</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('manage-investment-active')" href="{{ route('user.investments') }}">Manage Investments</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('profile-active')" href="{{ route('user.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @yield('password-active')" href="{{ url('/user/change-password') }}#">Change Password</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Log out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
