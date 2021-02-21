@extends('layouts.master')

@section('page_title', 'Tabela de pontos - ' . date('Y'))
@section('page_subtitle', 'Cadastro')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    @include('components.errors')

    <!-- CONSULT POINTS REALTOR -->
    @include('points-table._consult')

    <!-- POINTS TARGET -->
    @isset($realtorSelected)
        @include('points-table._target')
    @endisset

    <!-- SHOW TABLE POINTS REALTOR -->
    @isset($realtorSelected)
        <div class="card">
            <div class="card-header">
                <h4>{{ $quarter }}º trimeste de {{ date('Y') }}</h4>
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
                            <td class="text-center text-bold">{{ number_format($myPoints, 0, '', '.') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endisset

    <!-- REGISTER INFOS -->
    @isset($realtorSelected)
        @include('points-table._register-infos')
    @endisset

@endsection

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
            })
        });
    </script>
@endsection
