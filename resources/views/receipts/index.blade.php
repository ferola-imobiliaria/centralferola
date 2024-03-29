@extends('layouts.master')

@section('page_title', 'Recibos')
@section('page_subtitle', 'Controle de comissões')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
    <style>
        .list-group-item {
            background: transparent !important;
        }
    </style>
@endsection

@section('content')
    <!-- Consult -->
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('receipt.show') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-sm">
                        <select class="form-control select2bs4" name="commission" id="commission" style="width: 100%;">
                            <option></option>
                            @foreach($commissionsControls as $commissionControl)
                                <option
                                    value="{{ $commissionControl->uuid }}" {{ ($saleSelect ?? null) == $commissionControl->uuid ? 'selected' : '' }}>
                                    {{ $commissionControl->sale_date }} → {{ $commissionControl->owner }}
                                    ({{$commissionControl->property}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm">
                        <button class="btn btn-primary" type="submit">
                            Gerar recibos <i class="fas fa-share ml-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @isset($commission)
        <?php
        $usuario = $commission->user_id;
        $exclusivo = $commission->exclusive;
        $captador = $commission->catcher;

        if ($usuario === $exclusivo) {
            $valor1 = $commission->exclusive_commission;
        } else {
            $valor1 = 0;
        }
        if ($usuario === $captador) {
            $valor2 = $commission->catcher_commission;
        } else {
            $valor2 = 0;
        }
        ?>
        <div class="card card-danger card-outline">
            <div class="card-body">
                <div class="row">
                    <!-- RECIBO FEROLA -->
                    <div class="col-lg-3">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>FEROLA</h4>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <i class="fas fa-user-tie mr-2"></i>Ferola
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-money-bill-alt mr-2"></i>
                                        R$ {{ number_format($commission->real_estate_commission, 2, ',', '.') }}
                                        @if($commission->supervisor_commission)
                                            + R$ {{number_format($commission->supervisor_commission, 2, ',', '.')}}
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('receipt.generate', ['ferola',  $commission->uuid]) }}"
                               class="small-box-footer btn" target="_new">Visualizar recibo <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    @if($commission->user_id === $commission->catcher)
                        <!-- RECIBO CORRETOR -->
                        <div class="col-lg-3 col-sm-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>CORRETOR</h4>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <i class="fas fa-user-tie mr-2"></i> {{ $commission->user->name }}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-money-bill-alt mr-2"></i>
                                            R$ {{ number_format($commission->realtor_commission + $valor1 + $valor2, 2, ',', '.') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('receipt.generate', ['corretor',  $commission->uuid]) }}"
                                   class="small-box-footer btn" target="_new">Visualizar recibo <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @else
                        <!-- RECIBO CORRETOR -->
                        <div class="col-lg-3 col-sm-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>CORRETOR</h4>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <i class="fas fa-user-tie mr-2"></i> {{ $commission->user->name }}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-money-bill-alt mr-2"></i>
                                            R$ {{ number_format($commission->realtor_commission + $valor1 + $valor2, 2, ',', '.') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('receipt.generate', ['corretor',  $commission->uuid]) }}"
                                   class="small-box-footer btn" target="_new">Visualizar recibo <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif

                    <!-- ./col -->

                    <!-- RECIBO SUPERVISOR -->
                    <div class="col-lg-3 col-sm-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>SUPERVISOR</h4>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        @if($commission->supervisor)
                                            <i class="fas fa-user-tie mr-2"></i> {{ getUserName($commission->supervisor) }}
                                        @else
                                            <i class="fas fa-ban mr-2"></i> Venda sem supervisão
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-money-bill-alt mr-2"></i>
                                        {{ number_format($commission->supervisor_commission, 2, ',', '.') }}
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('receipt.generate', ['supervisor',  $commission->uuid]) }}"
                               class="small-box-footer btn @if(!$commission->supervisor) disabled @endif" target="_new">Visualizar
                                recibo <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    @if($commission->user_id === 1 && $commission->user_id != $commission->exclusive && $commission->exclusive != null)
                        <!-- RECIBO EXCLUSIVO -->
                        <div class="col-lg-3 col-sm-12">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h4>EXCLUSIVO</h4>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            @if($commission->exclusive)
                                                <i class="fas fa-user-tie mr-2"></i> {{ getUserName($commission->exclusive) }}
                                            @else
                                                <i class="fas fa-ban mr-2"></i> Venda sem exclusividade
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-money-bill-alt mr-2"></i>
                                            R$ {{ number_format($commission->exclusive_commission, 2, ',', '.') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('receipt.generate', ['exclusivo',  $commission->uuid]) }}"
                                   class="small-box-footer btn @if(!$commission->exclusive) disabled @endif"
                                   target="_new">
                                    Visualizar recibo <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    <!-- ./col -->
                    <!-- RECIBO DO PARCEIRO -->
                    @if($commission->nome_parceiro != '')
                        <!-- RECIBO CAPTADOR -->
                        <div class="col-lg-3 col-sm-12">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner">
                                    <h4>PARCEIRO</h4>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <i class="fas fa-user-tie mr-2"></i> {{ $commission->nome_parceiro }}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-money-bill-alt mr-2"></i>
                                            R$ {{ number_format($commission->sale_value_parceiro, 2, ',', '.') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('receipt.generate', ['parceiro',  $commission->uuid]) }}"
                                   class="small-box-footer bg-gradient-gray" target="_new">Visualizar recibo <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
                    <!-- ./col -->
                </div>
            </div>
        </div>
    @endisset
@endsection

@section('js')
    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('select#commission').select2({
                theme: "bootstrap",
                placeholder: 'Selecione a venda'
            });
        });
    </script>
@endsection
