<div class="container-fluid dashboard">

    <!-- EQUIPES E CORRETORES -->
    <div class="card card-danger card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users mr-1"></i> Equipes e corretores
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
                <!-- SEDE -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-success text-bold">Sede</span>
                            <span
                                class="info-box-number">{{ $teams->where('store', 'sede')->count() }} equipes</span>
                            <span class="info-box-number"> {{ $realtors_store['sede'] ?? 0}} corretores</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- NOROESTE -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-map-marker-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-danger text-bold">Noroeste</span>
                            <span
                                class="info-box-number">{{ $teams->where('store', 'noroeste')->count() }} equipes</span>
                            <span class="info-box-number">{{ $realtors_store['noroeste'] ?? 0 }} corretores</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- ÁGUAS CLARAS -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-map-marker-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-info text-bold">Águas Claras</span>
                            <span
                                class="info-box-number">{{ $teams->where('store', 'aguas_claras')->count() }} equipes</span>
                            <span class="info-box-number">{{ $realtors_store['aguas_claras'] ?? 0 }} corretores</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- TOTAL -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-navy"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-navy text-bold">Total</span>
                            <span class="info-box-number">{{ $teams->count() }} equipes</span>
                            <span class="info-box-number">{{ $realtors->count() }} corretores</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.card -->

    <!-- VGV's -->
    <div class="row">
        <!-- VGV MÊS ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i> VGV DO MÊS DE <u>{{ strtoupper(__(date('F'))) }}</u>
                        DE {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_vgv as $store => $vgv)
                        <div class="info-box bg-{{ $colors[$store] }}">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($vgv[date('n')], 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    @endforeach

                    <div class="info-box bg-navy">
                        <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                            <h2 class="info-box-number">
                                {{ number_format($totalVgv[date('n')], 2, ',', '.') }}
                            </h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>

        <!-- VGV TRIMESTRE ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i> VGV DO <u>{{currentQuarter()}}º TRIMESTRE</u>
                        DE {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_vgv as $store => $vgv)
                        <div class="info-box bg-{{ $colors[$store] }}">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($vgv->only(monthsOfQuarter(currentQuarter()))->sum(), 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    @endforeach
                    <div class="info-box bg-navy">
                        <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                            <h2 class="info-box-number">
                                {{ number_format($totalVgv->only(monthsOfQuarter(currentQuarter()))->sum(), 2, ',', '.') }}
                            </h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>

        <!-- VGV ANO ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i> VGV DE <u>{{ date('Y') }}</u>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_vgv as $store => $vgv)
                        <div class="info-box bg-{{ $colors[$store] }}">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($vgv->sum(), 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    @endforeach

                    <div class="info-box bg-navy">
                        <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                            <h2 class="info-box-number">
                                {{ number_format($totalVgv->sum(), 2, ',', '.') }}
                            </h2>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- COMISSÃO TOTAL LOJAS -->
    <div class="row">
        <!-- COMISSÃO MÊS ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-dollar-sign mr-1"></i> COMISSÃO DO MÊS DE
                        <u>{{ strtoupper(__(date('F'))) }}</u> DE {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_commission as $store => $vgv)
                        <div class="col-md">
                            <div class="info-box bg-{{ $colors[$store] }}">
                                {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                                <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                    <h2 class="info-box-number">
                                        {{ number_format($vgv[date('n')], 2, ',', '.') }}
                                    </h2>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    @endforeach
                    <div class="col-md">
                        <div class="info-box bg-navy">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($totalCommission[date('n')], 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md -->

        <!-- COMISSÃO TRIMESTRE ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-dollar-sign mr-1"></i> COMISSÃO DO <u> {{ currentQuarter() }}º TRIMESTRE</u>
                        DE {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_commission as $store => $vgv)
                        <div class="col-md">
                            <div class="info-box bg-{{ $colors[$store] }}">
                                {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                                <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                    <h2 class="info-box-number">
                                        {{ number_format($vgv->only(monthsOfQuarter(currentQuarter()))->sum(), 2, ',', '.') }}
                                    </h2>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    @endforeach
                    <div class="col-md">
                        <div class="info-box bg-navy">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($totalCommission->only(monthsOfQuarter(currentQuarter()))->sum(), 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md -->

        <!-- COMISSÃO ANO ATUAL -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-dollar-sign mr-1"></i> COMISSÃO DE <u>{{ date('Y') }}</u>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @foreach($stores_commission as $store => $vgv)
                        <div class="col-md">
                            <div class="info-box bg-{{ $colors[$store] }}">
                                {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                                <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    {{ strtoupper(__($store)) }}
                                </span>
                                    <h2 class="info-box-number">
                                        {{ number_format($vgv->sum(), 2, ',', '.') }}
                                    </h2>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    @endforeach
                    <div class="col-md">
                        <div class="info-box bg-navy">
                            {{--                            <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>--}}
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">
                                    TOTAL
                                </span>
                                <h2 class="info-box-number">
                                    {{ number_format($totalCommission->sum(), 2, ',', '.') }}
                                </h2>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md -->
    </div>
    <!-- /.row -->

    <!-- TOP 3 CORRETORES EM VGV -->
    <div class="row">
        <!-- TOP 3 CORRETORES EM VGV (SEDE) -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol mr-1"></i> TOP 3 VGV (Sede) - {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($rankingVgvSede as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">{{ number_format($realtor->sale_value, 2, ',', '.') }}
                                        <span class="badge badge-info float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                        {{ $realtor->name_short }} ({{$realtors->first()->team->name ?? ''}})
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- TOP 3 CORRETORES EM VGV (NOROESTE) -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol mr-1"></i> TOP 3 VGV (Noroeste) - {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($rankingVgvNoroeste as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">{{ number_format($realtor->sale_value, 2, ',', '.') }}
                                        <span class="badge badge-info float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">

                                        {{ $realtor->name_short }} ({{$realtors->first()->team->name}})
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- TOP 3 CORRETORES EM VGV (ÁGUAS CLARAS) -->
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-ol mr-1"></i> TOP 3 VGV (Águas Claras) - {{ date('Y') }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($rankingVgvAguasClaras as $realtor)
                            <li class="item">
                                <div class="product-img">
                                    <img
                                        src="{{ asset('storage/' . (Auth::user()->photo ?? '../images/no_photo.png')) }}"
                                        alt="Foto - {{ $realtor->name_short }}" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <span class="product-title">{{ number_format($realtor->sale_value, 2, ',', '.') }}
                                        <span class="badge badge-info float-right">{{ $loop->iteration }}º</span>
                                    </span>
                                    <span class="product-description">
                                        {{ $realtor->name_short }} ({{$realtors->first()->team->name}})
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

</div><!-- /.container-fluid -->
