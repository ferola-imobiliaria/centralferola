@extends('layouts.master')

@section('page_title', 'Gráficos')
@section('page_subtitle', 'Comissão anual')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- SEARCH -->
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('chart.supervisor.show', 'commission') }}" method="post">
                @csrf

                <div class="row">
                    <div class="form-group col-md">
                        <select class="form-control select2bs4" name="realtor" id="realtor" style="width: 100%;"
                                data-placeholder="Selecione o corretor">
                            <option value=""></option>
                            @foreach($team->users->sortBy('name_short') as $user)
                                <option value="{{ $user->id }}"
                                        @if(($realtorSelected ?? 0) == $user->id) selected @endif>
                                    {{ $user->name_short }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <select class="form-control select2bs4" name="field" id="field" style="width: 100%;"
                                data-placeholder="Selecione o item">
                            <option value=""></option>
                            <option value="sale">Vendas</option>
                            <option value="catcher">Captações</option>
                            <option value="exclusivity">Exclusividades</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <select class="custom-select" name="year" id="year">
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
