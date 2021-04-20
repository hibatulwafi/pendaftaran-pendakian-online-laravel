<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('pendaki.dashboard') }}"
                class="nav-link {{ request()->routeIs('pendaki.dashboard') == 'pendaki.dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Home
                </p>
            </a>
        </li>


       <li class="nav-item">
            <a href="{{ route('pendaki.pendaftaran.create') }}" class="nav-link {{ request()->routeIs('pendaki.pendaftaran.create') == 'pendaki.pendaftaran.create' ? 'active' : '' }}">
                <i class="fa fa-book nav-icon   "></i>
                <p>
                    Pendaftaran
                </p>
            </a>
        </li>

       <li class="nav-item">
            <a href="{{ route('pendaki.anggota') }}" class="nav-link {{ request()->routeIs('pendaki.anggota') == 'pendaki.anggota' ? 'active' : '' }}">
                <i class="fa fa-users nav-icon   "></i>
                <p>
                    Anggota
                </p>
            </a>
        </li>

       <li class="nav-item">
            <a href="{{ route('pendaki.status') }}" class="nav-link {{ request()->routeIs('pendaki.status') == 'pendaki.status' ? 'active' : '' }}">
                <i class="fa fa-check-square nav-icon   "></i>
                <p>
                    Status Pendakian
                </p>
            </a>
        </li>
        
       <li class="nav-item">
            <a href="{{ route('pendaki.riwayat') }}" class="nav-link {{ request()->routeIs('pendaki.riwayat') == 'pendaki.riwayat' ? 'active' : '' }}">
                <i class="fa fa-history nav-icon   "></i>
                <p>
                    Riwayat Pendakian
                </p>
            </a>
        </li>


       <!--  <li class="nav-item">
            <a href="{{ route('profile.show', auth()->guard('pendaki')->id()) }}" class="nav-link {{ request()->routeIs('profile.show') == 'profile.show' ? 'active' : '' }}">
                <i class="fas fa-user-ninja nav-icon   "></i>
                <p>
                    Profile
                </p>
            </a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt text-cyan   "></i>
                <p>
                    Logout
                </p>
                {{-- {{ __('Logout') }} --}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>