<div class="row">
    <!-- COMISSÃO MENSAL POR LOJA -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> COMISSÃO MÊS ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $commissionMonthsChart->container() !!}
            </div>
        </div>
    </div>

    <!-- COMISSÃO TRIMESTRAL POR LOJA -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> COMISSÃO TRIMESTRE ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $commissionQuarterChart->container() !!}
            </div>
        </div>
    </div>

    <!-- COMISSÃO ANUAL POR LOJA -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> COMISSÃO ANO ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $commissionYearChart->container() !!}
            </div>
        </div>
    </div>
</div>



