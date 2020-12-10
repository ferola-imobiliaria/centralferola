@extends('layouts.master')

@section('page_title', 'Gráficos')


@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4><i class="fas fa-money-check-alt mr-2"></i> Ganhos com comissões</h4>
                </div>
                <div class="card-body">
                    {!! $commissionChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4><i class="fas fa-search-dollar mr-2"></i> Ganhos com captações</h4>
                </div>
                <div class="card-body">
                    {!! $catcherChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h4><i class="fas fa-file-signature mr-2"></i> Ganhos com exclusividades</h4>
                </div>
                <div class="card-body">
                    {!! $exclusiveChart->container() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- ChartJS -->
    <script src="{{ asset('js/Chart.js') }}"></script>

    {!! $commissionChart->script() !!}
    {!! $catcherChart->script() !!}
    {!! $exclusiveChart->script() !!}
@endsection
