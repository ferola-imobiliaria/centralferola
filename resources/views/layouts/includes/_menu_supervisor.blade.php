<li class="nav-header">MENU SUPERVISOR</li>

<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link {{ isActive('user.index') }}">
        <i class="nav-icon fas fa-user-friends"></i>
        <p>Corretores</p>
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

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>
            Gráficos
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('chart.supervisor.index', 'producao') }}"
               class="nav-link {{ isActive('chart.supervisor.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Produção anual</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('chart.supervisor.index', 'comissao') }}"
               class="nav-link {{ isActive('chart.supervisor.index') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Comissão anual</p>
            </a>
        </li>
    </ul>
</li>
