<aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link navbar-white">
        <img src="{{ asset('images/logo-home.png') ?? ''}}" alt="Ferola Logo" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                     class="img-circle elevation-2" alt="{{ Auth::user()->name_short }}">
            </div>
            <div class="info">
                <span class="d-block text-white">{{ Auth::user()->name_short }}</span>
                <small class="text-white">{{ Auth::user()->team->name ?? __(Auth::user()->profile) }}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @can('is-admin')
                    @include('layouts.includes._menu_admin')
                @endcan

                @cannot('is-admin')
                    @include('layouts.includes._menu_realtor')
                @endcannot

                @can('is-supervisor')
                    @include('layouts.includes._menu_supervisor')
                @endcan

                <li class="nav-item mt-4 border-top">
                    <a href="{{ route('informative.index') }}" class="nav-link {{ isActive('informative.index') }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Informativos e arquivos</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
