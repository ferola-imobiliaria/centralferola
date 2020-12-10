<div class="container-fluid dashboard">
    <!-- MEUS GANHOS -->
    @include('dashboard.components.my_ernings')

    <!-- PRODUÇÂO -->
    <div class="row">
        <!-- PRODUÇÃO DO MÊS -->
        <div class="col-md-6">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i> Minha produção em {{ __(date('F')) }}/{{ date('Y') }}
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
                        <!-- VGV -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">VGV (R$)</small>
                                    <h5 class="info-box-number">
                                        {{ number_format( $userMonthProduction['vgv'], 0, '', '.') ?? '0,00' }}
                                    </h5>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- VENDAS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-fuchsia">
                                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">VENDAS</small>
                                    <h3 class="info-box-number">{{ $userMonthProduction['sales'] ?? 0}}</h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- EXCLUSIVIDADES -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">EXCLUSIVIDADES</small>
                                    <h3 class="info-box-number">
                                        {{ $userMonthProduction['captured_exclusivities'] ?? 0}}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- CAPTAÇÕES -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-search-dollar"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">CAPTAÇÕES</small>
                                    <h3 class="info-box-number">
                                        {{ $userMonthProduction['captured_properties'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ANÚNCIOS PUBLICADOS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-gray">
                                <span class="info-box-icon"><i class="fas fa-camera"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">ANÚNCIOS PUBLICADOS</small>
                                    <h3 class="info-box-number">
                                        {{ $userMonthProduction['published_ads'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- PROPOSTAS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-purple">
                                <span class="info-box-icon"><i class="fas fa-calculator"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">PROPOSTAS</small>
                                    <h3 class="info-box-number">
                                        {{ $userMonthProduction['proposals'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <!-- PRODUÇÃO DO ANO -->
        <div class="col-md-6">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i> Minha produção do ano {{ date('Y') }}
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
                        <!-- VGV -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">VGV (R$)</small>
                                    <h5 class="info-box-number">
                                        {{ number_format( $userYearProduction['vgv'], 0, '', '.') ?? '0,00' }}
                                    </h5>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- VENDAS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-fuchsia">
                                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">VENDAS</small>
                                    <h3 class="info-box-number">{{ $userYearProduction['sales'] ?? 0}}</h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- EXCLUSIVIDADES -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">EXCLUSIVIDADES</small>
                                    <h3 class="info-box-number">
                                        {{ $userYearProduction['captured_exclusivities'] ?? 0}}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- CAPTAÇÕES -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-search-dollar"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">CAPTAÇÕES</small>
                                    <h3 class="info-box-number">
                                        {{ $userYearProduction['captured_properties'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ANÚNCIOS PUBLICADOS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-gray">
                                <span class="info-box-icon"><i class="fas fa-camera"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">ANÚNCIOS PUBLICADOS</small>
                                    <h3 class="info-box-number">
                                        {{ $userYearProduction['published_ads'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- PROPOSTAS -->
                        <div class="col-lg-4 col-6">
                            <div class="info-box mb-3 bg-purple">
                                <span class="info-box-icon"><i class="fas fa-calculator"></i></span>
                                <div class="info-box-content">
                                    <small class="info-box-text">PROPOSTAS</small>
                                    <h3 class="info-box-number">
                                        {{ $userYearProduction['proposals'] ?? 0 }}
                                    </h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- ./col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <!-- MINHA EQUIPE -->
    @include('dashboard.components.my_team')

</div><!-- /.container-fluid -->
