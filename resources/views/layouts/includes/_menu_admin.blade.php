<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link {{ isActive('user.index') }}">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>Corretores</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('team.index') }}" class="nav-link {{ isActive('team.index') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Equipes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('placings.index') }}" class="nav-link {{ isActive('placings.index') }}">
        <i class="nav-icon fas fa-medal"></i>
        <p>Classificações</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('financial.index') }}" class="nav-link {{ isActive('financial.index') }}">
        <i class="nav-icon fas fa-dollar-sign"></i>
        <p>Financeiro</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>
            Relatórios
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('report.production.índex') }}"
               class="nav-link {{ isActive('report.production.índex') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Produção mensal</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('report.commissions-control.index') }}"
               class="nav-link {{ isActive('report.commissions-control.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Controle de Comissões</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('report.points-table.index') }}"
               class="nav-link {{ isActive('report.points-table.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tabela de pontos</p>
            </a>
        </li>
    </ul>
</li>
