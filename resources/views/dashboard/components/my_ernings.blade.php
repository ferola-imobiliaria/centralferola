<div class="row">
    <!-- MEUS GANHOS NO MÊS -->
    <div class="col-md-6">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-hand-holding-usd mr-1"></i> Meus ganhos em {{ __(date('F')) }}/{{ date('Y') }}
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <div class="row">
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Comissões de venda</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($monthErnings['realtor']['realtor_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Captações</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($monthErnings['catcher']['catcher_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Exclusividades</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($monthErnings['exclusive']['exclusive_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    @can('is-supervisor')
                        <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Supervisão</span>
                                    <h4 class="info-box-number text-center text-muted mb-0">
                                        R$ {{ number_format($monthErnings['supervisor']['supervisor_ernings'], 2, ',', '.') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- MEUS GANHOS NO ANO -->
    <div class="col-md-6">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-hand-holding-usd mr-1"></i> Meus ganhos em {{ date('Y') }}
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <div class="row">
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Comissões de venda</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($yearErnings['realtor']['realtor_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Captações</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($yearErnings['catcher']['catcher_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Exclusividades</span>
                                <h4 class="info-box-number text-center text-muted mb-0">
                                    R$ {{ number_format($yearErnings['exclusive']['exclusive_ernings'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    @can('is-supervisor')
                        <div class="{{ (Auth::user()->profile === 'supervisor' ? 'col-md-6' : 'col-md') }}">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Supervisão</span>
                                    <h4 class="info-box-number text-center text-muted mb-0">
                                        R$ {{ number_format($yearErnings['supervisor']['supervisor_ernings'], 2, ',', '.') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
