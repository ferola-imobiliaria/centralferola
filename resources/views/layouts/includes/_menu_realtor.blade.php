<li class="nav-header">MENU CORRETOR</li>

<li class="nav-item">
    <a href="{{ route('production.index') }}" class="nav-link {{ isActive('production.index') }}">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>Minha produção</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('commissions-control.index') }}"
       class="nav-link {{ isActive('commissions-control.index') }}">
        <i class="nav-icon fas fa-hand-holding-usd"></i>
        <p>Controle de Comissões</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('points-table.index') }}"
       class="nav-link {{ isActive('points-table.index') }}">
        <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
        <p>Tabela de pontos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('receipt.index') }}" class="nav-link {{ isActive('receipt.index') }}">
        <i class="nav-icon fas fa-receipt"></i>
        <p>Recibos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('chart.realtor') }}" class="nav-link {{ isActive('chart.realtor') }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Gráficos de ganhos (R$)</p>
    </a>
</li>
