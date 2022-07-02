@if($quarterTarget)

    <div class="card card-danger card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-sort-numeric-up-alt mr-1"></i> Minha pontuação no {{ currentQuarter() }}º
                trimestre/{{ date('Y') }}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <div class="info-box bg-gradient-danger">
                <span class="info-box-icon bg-danger col-md-1 col-sm-2"><i class="fas fa-bullseye"></i></span>

                <div class="info-box-content col">

                    @switch($quarterTotalScore)
                        @case($quarterTotalScore >= ($quarterTarget * 2))
                            <div class="progress">
                                @if($quarterTarget)
                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{ 100 * $quarterTotalScore / $quarterTarget }}%; background: #808080"></div>
                                @else
                                    <div class="progress-bar" style="width: 0%"></div>
                                @endif
                            </div>
                            <h5>
                                <i class="fas fa-trophy mr-2"></i>
                                PARABÉNS!!! VOCÊ DOBROU A META DE {{ number_format($quarterTarget, 0, '', '.') }} PONTOS
                                DESTE
                                TRIMESTRE.
                                <i class="fas fa-wine-bottle ml-2"></i><i class="fas fa-wine-glass-alt ml-1"></i>
                                <p><strong>PLATINA</strong></p>
                            </h5>
                            <span class="info-box-number">
                        MEUS PONTOS: {{ number_format($quarterTotalScore, 0, '', '.') }}
                                {{--                    (Meta deste trimestre: {{ number_format($quarterTarget, 0, '', '.') }} pontos)--}}
                    </span>
                            @break
                        @case($quarterTotalScore >= $quarterTarget)
                            <div class="progress">
                                @if($quarterTarget)

                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{ 50 * $quarterTotalScore / $quarterTarget }}%;"><p>Platina</p></div>
                                @else
                                    <div class="progress-bar" style="width: 0%"></div>
                                @endif
                            </div>
                            <h5>
                                <i class="fas fa-trophy mr-2"></i>
                               VOCÊ ATINGIU A META <p style="color: #ffbf00; display: inline">GOLD</p> {{ number_format($quarterTarget, 0, '', '.') }} PONTOS
                                DESTE
                                TRIMESTRE.
                            </h5>
                            <span class="info-box-number">
                        MEUS PONTOS: {{ number_format($quarterTotalScore, 0, '', '.') }}
                                {{--                    (Meta deste trimestre: {{ number_format($quarterTarget, 0, '', '.') }} pontos)--}}
                    </span>
                            <span class="progress-description" style="white-space: normal;">
                        Falta {{ number_format(($quarterTarget * 2) - $quarterTotalScore , 0, '', '.') }} ponto(s) para você se tornar <b>Platina</b>
                    </span>
                            @break
                        @default
                            <div class="progress">
                                @if($quarterTarget)

                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{ 100 * $quarterTotalScore / $quarterTarget }}%;"></div>
                                @else
                                    <div class="progress-bar" style="width: 0%"></div>
                                @endif
                            </div>
                            <span class="progress-description" style="white-space: normal;">
                        Falta {{ number_format($quarterTarget - $quarterTotalScore, 0, '', '.') }} ponto(s) para você se tornar <b
                                    style="color: #ffbf00;">GOLD</b>
                    </span>
                    @endswitch
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <!-- /.card -->
@endif



{{--                                <span class="info-box-text">Meta deste trimestre: {{ $quarterTarget }}</span>--}}
@if($quarterTotalScore < $quarterTarget)
    <span class="info-box-number">
                        MEUS PONTOS: {{ number_format($quarterTotalScore, 0, '', '.') }}
        {{--                    (Meta deste trimestre: {{ number_format($quarterTarget, 0, '', '.') }} pontos)--}}
                    </span>

    <div class="progress">
        @if($quarterTarget)
            <div class="progress-bar" role="progressbar"
                 style="width: {{ 100 * $quarterTotalScore / $quarterTarget }}%"></div>
        @else
            <div class="progress-bar" style="width: 0%"></div>
        @endif
    </div>

@else

@endif
@if($quarterTotalScore >= ($quarterTarget * 2))

@endif
