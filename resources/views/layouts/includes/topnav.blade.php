<nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-users-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Configurações</span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.edit', Auth::user()->uuid) }}" class="dropdown-item">
                    <i class="fas fa-user-edit mr-2"></i> Editar minhas informações
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.change.password.form') }}" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Trocar senha
                </a>
            </div>
        </li>
        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link text-gray-600" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                {{ __('Sair') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
