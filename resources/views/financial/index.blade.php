@extends('layouts.master')

@section('page_title', 'Financeiro')

@section('content')
    @include('financial._vgv')
    @include('financial._commission')
@endsection


@section('js')
    <!-- ChartJS -->
    <script src="{{ asset('js/Chart.js') }}"></script>

    {!! $vgvMonthsChart->script() !!}
    {!! $vgvQuarterChart->script() !!}
    {!! $vgvYearChart->script() !!}

    {!! $commissionMonthsChart->script() !!}
    {!! $commissionQuarterChart->script() !!}
    {!! $commissionYearChart->script() !!}
@endsection
