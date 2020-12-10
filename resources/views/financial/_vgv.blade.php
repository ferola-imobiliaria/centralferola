<div class="row">
    <!-- VGV MENSAL POR LOJA -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> VGV MÊS ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $vgvMonthsChart->container() !!}
            </div>
        </div>
    </div>

    <!-- VGV TRIMESTRAIS -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> VGV TRIMESTRE ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $vgvQuarterChart->container() !!}
            </div>
        </div>
    </div>

    <!-- VGV ANUAIS -->
    <div class="col">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h4><i class="fas fa-file-signature mr-2"></i> VGV ANO ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                {!! $vgvYearChart->container() !!}
            </div>
        </div>
    </div>
</div>
