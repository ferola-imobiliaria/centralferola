@if ($quarterTarget)
<div class="info-box bg-gradient-danger">
    <span class="info-box-icon bg-danger"><i class="fas fa-bullseye"></i></span>

    <div class="info-box-content">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-left">
                <h6>
                    Meta deste trimestre: <span class="text-bold"
                        id="targetPoints">{{ number_format($quarterTarget, 0, '', '.') }}</span> pontos
                </h6>

                @if ($myPoints < $quarterTarget) <h6>Faltam <span id="missingPoints"
                        class="text-bold">{{ number_format(($quarterTarget - $myPoints), 0, '', '.') }}</span> pontos
                    para atingir a meta deste trimestre.</h6>
                    @else
                    <h6 class="text-bold"><i class="fas fa-trophy mr-2"></i> PARABÉNS!!! VOCÊ ATINGIU A META DE PONTOS
                        DESTE TRIMESTRE.</h6>
                    @endif
            </div>

            <div class="col-md-6 col-sm-12 text-right">
                <span class="mr-2">meus pontos: </span>
                <b>{{ number_format($myPoints, 0, '', '.') }}</b> /
                <small>{{ number_format($quarterTarget, 0, '', '.') }}</small>

                <div class="progress progress-bar-striped progress-bar-animated">
                    <div class="progress-bar bg-info" @if ($quarterTarget)
                        style="width: {{ ($myPoints / $quarterTarget) * 100 }}%" @else style="width: 0" @endif>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.info-box-content -->
</div>

@else


<div class="info-box bg-gradient-danger">
    <span class="info-box-icon bg-danger"><i class="fas fa-bullseye"></i></span>

    <div class="info-box-content">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h5>ESTE TRIMESTE AINDA NÃO PUSSUI UMA META DE PONTOS DEFINIDA.</h5>
            </div>
        </div>

    </div>
    <!-- /.info-box-content -->
</div>


@endif