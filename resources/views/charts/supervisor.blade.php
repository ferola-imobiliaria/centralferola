@extends('layouts.master')

@section('page_title', 'Gráficos')
@if($type == 'producao')
    @section('page_subtitle', 'Produção anual')
@elseif($type == 'comissao')
    @section('page_subtitle', 'Comissão anual')
@endif

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <!-- SEARCH -->
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('chart.supervisor.show', $type) }}" method="post">
                @csrf


                <div class="row">
                    <div class="form-group col-md">
                        <select class="form-control select2bs4" name="realtor" id="realtor" required
                                style="width: 100%;"
                                data-placeholder="Selecione o corretor">
                            <option value=""></option>

                            @foreach($team as $user)
                                <option value="{{ $user->id }}"
                                        @if(($realtorSelected ?? 0) == $user->id) selected @endif>
                                    {{ $user->name_short }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md">
                        @if($type == 'producao')
                            <select class="form-control select2bs4" name="field" id="field" required
                                    style="width: 100%;"
                                    data-placeholder="Selecione o item">
                                <option value=""></option>
                                <option value="captured_properties"
                                    {{ ('captured_properties' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Imóveis captados
                                </option>
                                <option value="captured_exclusivities"
                                    {{ ('captured_exclusivities' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Exclusividades captadas
                                </option>
                                <option value="published_ads"
                                    {{ ('published_ads' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Anúncios publicados
                                </option>
                                <option value="plaques"
                                    {{ ('plaques' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Placas
                                </option>
                                <option value="captures_sold"
                                    {{ ('captures_sold' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Captações vendidas
                                </option>
                                <option value="sales"
                                    {{ ('sales' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Vendas
                                </option>
                                <option value="vgv"
                                    {{ ('vgv' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    VGV
                                </option>
                                <option value="proposals"
                                    {{ ('proposals' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Propostas
                                </option>
                                <option value="exclusivities_sold"
                                    {{ ('exclusivities_sold' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Exclusividades vendidas
                                </option>
                            </select>
                        @elseif($type == 'comissao')

                            <select class="form-control select2bs4" name="field" id="field" required
                                    style="width: 100%;"
                                    data-placeholder="Selecione o item">
                                <option value=""></option>
                                <option value="realtor_commission"
                                    {{ ('realtor_commission' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Comissão de vendas
                                </option>
                                <option value="catcher_commission"
                                    {{ ('catcher_commission' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Comissão de captações
                                </option>
                                <option value="exclusive_commission"
                                    {{ ('exclusive_commission' == ($fieldSelected ?? '') ? 'selected' : '') }}>
                                    Comissão de exclusividades
                                </option>
                            </select>
                        @endif
                    </div>
                    <div class="form-group col-md">
                        <select class="custom-select" name="year" id="year" required>
                            @foreach(\App\Helpers\Date::intervalYear(now()->year, '2020') as $year)
                                <option value="{{ $year }}"
                                    {{ ($year == ($yearSelected ?? '') ? 'selected' : '') }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- CHART -->
    @isset($chart)

        <div class="row">
            <div class="col-md">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-chart-bar mr-2"></i> {{ strtoupper(__($fieldSelected)) }}
                            - {{ $yearSelected }} -
                            @if($type === 'producao')
                                Total: {{number_format($chart->resultado, 2, ',', '.')}}
                            @else
                                Total: {{number_format($chart->resultado, 2, ',','.')}}
                            @endif

                        </h4>
                    </div>
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    @endisset

@endsection

@section('js')
    <!-- ChartJS -->
    <script src="{{ asset('js/Chart.js') }}"></script>

    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('select').select2({
                theme: "bootstrap",
                placeholder: function () {
                    $(this).data('placeholder');
                }
            })
        });
    </script>

    @isset($chart)
        {!! $chart->script() !!}
    @endisset

@endsection

