@extends('layouts.master')

@section('page_title', 'Relatórios')
@section('page_subtitle', 'Tabela de pontos')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection


@section('content')

    @can('is-admin')
        <div class="row mb-3">
            <div class="col text-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal">
                    <i class="fas fa-cog mr-2"></i> pontuação / meta trimestral
                </button>
            </div>
        </div>
    @endcan

    <!-- Consult -->
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('report.points-table.show') }}" method="post">
                @csrf

                <div class="row">
                    @can('is-admin-or-supervisor')
                        <div class="form-group col-sm">
                            <select class="form-control select2bs4" name="realtor" id="realtor" style="width: 100%;">
                                <option value="">» Corretor «</option>
                                @foreach($teams as $team)
                                    <optgroup label="{{ $team->name }}">
                                        @foreach($team->users->sortBy('name_short') as $user)
                                            <option value="{{ $user->id }}"
                                                    @if(($realtorSelected ?? 0) == $user->id) selected @endif>
                                                {{ $user->name_short }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    @endcan
                    <div class="form-group col-sm">
                        <select class="custom-select" name="quarter" id="quarter">
                            <option value="1" @if($quarter == 1) selected @endif>1º trimestre</option>
                            <option value="2" @if($quarter == 2) selected @endif>2º trimestre</option>
                            <option value="3" @if($quarter == 3) selected @endif>3º trimestre</option>
                            <option value="4" @if($quarter == 4) selected @endif>4º trimestre</option>
                        </select>
                    </div>
                    <div class="form-group col-sm">
                        <select class="custom-select" name="year" id="year">
                            @foreach(\App\Helpers\Date::intervalYear(now()->year, '2020') as $year)
                                <option value="{{ $year }}"
                                    {{ ($year == ($yearSelected ?? '') ? 'selected' : '') }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SHOW TABLE POINTS REALTOR -->
    @isset($realtorSelected)
        <div class="card">
            <div class="card-header">
                <h4>{{ $quarter }}º trimeste de {{ $yearSelected }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center pointsTable" id="pointsTable">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Mês</th>
                            <th scope="col" id="scoreCapturedProperties"
                                data-score="{{ $pointsTable->score_captured_properties ?? 0 }}">
                                Imóveis captados ({{ $pointsTable->score_captured_properties ?? 0 }} pts)
                            </th>
                            <th scope="col" id="scoreCapturedExclusives"
                                data-score="{{ $pointsTable->score_captured_exclusives ?? 0 }}">
                                Exclusividades ({{ $pointsTable->score_captured_exclusives ?? 0 }} pts)
                            </th>
                            <th scope="col" id="scorePublishedAds"
                                data-score="{{ $pointsTable->score_published_ads ?? 0 }}">
                                Anúncios publicados ({{ $pointsTable->score_published_ads ?? 0 }} pts)
                            </th>
                            <th scope="col" id="scorePlaques"
                                data-score="{{ $pointsTable->score_plaques ?? 0 }}">
                                Placas ({{ $pointsTable->score_plaques ?? 0 }} pts)
                            </th>
                            <th scope="col" id="scoreSales"
                                data-score="{{ $pointsTable->score_sales ?? 0 }}">
                                Vendas ({{ $pointsTable->score_sales ?? 0 }} pts)
                            </th>
                            <th scope="col">
                                Total de pontos
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productions as $month => $production)
                            <tr>
                                <th scope="row">{{ \Carbon\Carbon::createFromFormat('m', $month)->monthName }}</th>
                                <td>{{ $production->captured_properties ?? 0 }}</td>
                                <td>{{ $production->captured_exclusivities ?? 0 }}</td>
                                <td>{{ $production->published_ads ?? 0 }}</td>
                                <td>{{ $production->plaques ?? 0 }}</td>
                                <td>{{ $qtdSalesRealtor[$loop->index] }}</td>
                                <td class="table-secondary text-bold totalMonth">0</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-gray-light">
                            <td colspan="6" class="text-right"><strong>Total do trimestre:</strong></td>
                            <td class="text-center text-bold totalQuarterPoints">0</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endisset
@endsection



<!-- MODAL FORM STORE POINTS AND TARGETS -->
@can('is-admin')
    <div class="modal fade show" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('points-table.store.points.targets') }}" method="post">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Pontuação / Metas trimestrais - {{ date('Y') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card card-danger card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                           href="#scores" role="tab" aria-controls="custom-tabs-four-home"
                                           aria-selected="true">
                                            Pontuações
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                           href="#targets" role="tab"
                                           aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            Metas trimestrais
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- TAB SCORES -->
                                    <div role="tabpanel" class="tab-pane active" id="scores">
                                        <div class="form-group row">
                                            <label for="score_captured_properties" class="col-sm-6 col-form-label">
                                                Imóveis Captados
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="100" class="form-control"
                                                       id="score_captured_properties"
                                                       name="score_captured_properties"
                                                       value="{{ $pointsTable->score_captured_properties ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="score_captured_exclusives" class="col-sm-6 col-form-label">
                                                Exclusividades Captadas
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="100" class="form-control"
                                                       id="score_captured_exclusives"
                                                       name="score_captured_exclusives"
                                                       value="{{ $pointsTable->score_captured_exclusives ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="score_published_ads" class="col-sm-6 col-form-label">
                                                Anúncios publicados
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="100" class="form-control"
                                                       id="score_published_ads"
                                                       name="score_published_ads"
                                                       value="{{ $pointsTable->score_published_ads ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="score_plaques" class="col-sm-6 col-form-label">
                                                Placas penduradas
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="100" class="form-control"
                                                       id="score_plaques"
                                                       name="score_plaques"
                                                       value="{{ $pointsTable->score_plaques ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="score_sales" class="col-sm-6 col-form-label">Vendas</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="100" class="form-control"
                                                       id="score_sales"
                                                       name="score_sales"
                                                       value="{{ $pointsTable->score_sales ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB TARGETS -->
                                    <div role="tabpanel" class="tab-pane" id="targets">
                                        <div class="form-group row">
                                            <label for="target_first_quarter" class="col-sm-3 col-form-label">
                                                1º trimestre
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="number" min="0" step="1000" class="form-control"
                                                       style="width: 50%"
                                                       id="target_first_quarter"
                                                       name="target_first_quarter"
                                                       value="{{ $pointsTable->target_first_quarter ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="target_second_quarter" class="col-sm-3 col-form-label">
                                                2º trimestre
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="number" min="0" step="1000" class="form-control"
                                                       style="width: 50%"
                                                       id="target_second_quarter"
                                                       name="target_second_quarter"
                                                       value="{{ $pointsTable->target_second_quarter ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="target_third_quarter" class="col-sm-3 col-form-label">
                                                3º trimestre
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="number" min="0" step="1000" class="form-control"
                                                       style="width: 50%"
                                                       id="target_third_quarter"
                                                       name="target_third_quarter"
                                                       value="{{ $pointsTable->target_third_quarter ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="target_fourth_quarter" class="col-sm-3 col-form-label">
                                                4º trimestre
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="number" min="0" step="1000" class="form-control"
                                                       style="width: 50%"
                                                       id="target_fourth_quarter"
                                                       name="target_fourth_quarter"
                                                       value="{{ $pointsTable->target_fourth_quarter ?? 0 }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Fechar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endcan

@section('js')
    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>
    <!-- POINTS TABLE SCRIPTS -->
    <script src="{{ asset('js/points-table.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('select#realtor').select2({
                theme: "bootstrap"
            });

            $(function () {
                //Initialize Modal
                $('#modal').on('shown.bs.modal', function () {
                    $('#myInput').focus()
                })
            });
        });

    </script>
@endsection
