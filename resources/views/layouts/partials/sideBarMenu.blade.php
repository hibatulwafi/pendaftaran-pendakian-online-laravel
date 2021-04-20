<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') == 'home' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>


        @if (auth()->user()->can('manajemen users'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'users' || request()->segment(1) == 'roles' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'users' || request()->segment(1) == 'roles' ) ? 'active' : '' }}">
                <i class="fas fa-user-astronaut nav-icon   "></i>
                <p>
                    Manajemen Admin
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('manajemen users')
                    <li class="nav-item">
                        <a href="{{ route('users.create') }}"
                            class="nav-link {{ request()->routeIs('users.create') == 'users.create' ? 'active' : '' }}">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Tambah Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.index') == 'users.index' ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon   "></i>
                            <p>List Data Admin</p>
                        </a>
                    </li> 
                @endcan

              <!--   <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.index') == 'roles.index' ? 'active' : '' }}">
                        <i class="fas fa-users-cog nav-icon   "></i>
                        <p>Role & Permission</p>
                    </a>
                </li> -->
            </ul>
        </li>
        @endif


        @if (auth()->user()->can('manajemen produk') || auth()->user()->can('manajemen kategori'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'gunung' || request()->segment(1) == 'jalur' || request()->segment(1) == 'pos' || request()->segment(1) == 'fasilitas' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'gunung' || request()->segment(1) == 'jalur' || request()->segment(1) == 'pos' || request()->segment(1) == 'fasilitas') ? 'active' : '' }}">
                <i class="fas fa-cubes nav-icon    "></i>
                <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('manajemen produk')
                  
                @endcan

                @can('manajemen kategori')
                   
                @endcan

                    <li class="nav-item">
                        <a href="{{ route('gunung.index') }}"
                            class="nav-link {{ request()->routeIs('gunung.index') == 'gunung.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-eject nav-icon   "></i>
                            <p>Gunung</p>
                        </a>
                    </li>  

                    <li class="nav-item">
                        <a href="{{ route('jalur.index') }}"
                            class="nav-link {{ request()->routeIs('jalur.index') == 'jalur.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-map nav-icon   "></i>
                            <p>Jalur</p>
                        </a>
                    </li>  

                    <li class="nav-item">
                        <a href="{{ route('pos.index') }}"
                            class="nav-link {{ request()->routeIs('pos.index') == 'pos.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-map-signs nav-icon   "></i>
                            <p>Pos</p>
                        </a>
                    </li>  

                    <li class="nav-item">
                        <a href="{{ route('fasilitas.index') }}"
                            class="nav-link {{ request()->routeIs('fasilitas.index') == 'fasilitas.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-life-ring  nav-icon   "></i>
                            <p>Fasilitas</p>
                        </a>
                    </li>  

            </ul>
        </li>
        @endif


        @if (auth()->user()->can('manajemen pendakian'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'permohonan' || request()->segment(1) == 'statuspendakian' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'permohonan' || request()->segment(1) == 'statuspendakian' ) ? 'active' : '' }}">
                <i class="fas fa fa-sign-language nav-icon    "></i>
                <p>
                    Pendakian
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('permohonan') }}"
                            class="nav-link {{ request()->routeIs('permohonan') == 'permohonan' ? 'active' : '' }}">
                            ▹<i class="fas fa-box-open nav-icon   "></i>
                            <p>Permohonan Pendakian</p>
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a href="{{ route('statuspendakian.index') }}"
                            class="nav-link {{ (request()->routeIs('statuspendakian.index') == 'statuspendakian.index' || request()->routeIs('statuspendakian.edit') == 'statuspendakian.edit' )? 'active' : '' }}">
                            ▹<i class="fas fa-puzzle-piece nav-icon   "></i>
                            <p>Status Pendakian</p>
                        </a>
                    </li>  

                   <!--  <li class="nav-item">
                        <a href="{{ route('pendaftaran.index') }}"
                            class="nav-link {{ request()->routeIs('pendaftaran.index') == 'pendaftaran.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-puzzle-piece nav-icon   "></i>
                            <p>Pendaftaran</p>
                        </a>
                    </li>  -->
            </ul>
        </li>
        @endif

          @if (auth()->user()->can('manajemen laporan'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'laporan' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'laporan' ) ? 'active' : '' }}">
                <i class="fas fa-book nav-icon   "></i>
                <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
             @can('manajemen laporan')
                    <!-- <li class="nav-item">
                        <a href="{{ route('users.create') }}"
                            class="nav-link {{ request()->routeIs('users.create') == 'users.create' ? 'active' : '' }}">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Laporan Penyewaan</p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}"
                            class="nav-link {{ request()->routeIs('laporan.index') == 'laporan.index' ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon   "></i>
                            <p>Laporan Pendakian</p>
                        </a>
                    </li> 
            @endcan
            </ul>
        </li>
        @endif



        @if (auth()->user()->can('manajemen users'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'pendaki' || request()->segment(1) == 'pendaki' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'pendaki' || request()->segment(1) == 'pendaki' ) ? 'active' : '' }}">
                <i class="fas fa-blind nav-icon   "></i>
                <p>
                    Data Pendaki
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('manajemen users')
                    <li class="nav-item">
                        <a href="{{ route('pendaki.index') }}"
                            class="nav-link {{ request()->routeIs('pendaki.index') == 'pendaki.index' ? 'active' : '' }}">
                            ▹<i class="fas fa-users nav-icon   "></i>
                            <p>Data Pendaki</p>
                        </a>
                    </li> 
                @endcan

            </ul>
        </li>
        @endif


        @role('admin') 
        <li class="nav-item">
            <a href="{{ route('setting.index') }}" class="nav-link {{ request()->routeIs('setting.index') == 'setting.index' ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon   "></i>
                <p>
                    Settings
                </p>
            </a>
        </li>
        @endrole

        <li class="nav-item">
            <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-link {{ request()->routeIs('profile.show') == 'profile.show' ? 'active' : '' }}">
                <i class="fas fa-user-ninja nav-icon   "></i>
                <p>
                    Profile
                </p>
            </a>
        </li>

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