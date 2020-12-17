@extends('layouts.master')

@section('page_title', 'Produção')
@section('page_subtitle', 'cadastrar')

@section('content')

    {{-- CONSULT PRODUCTION --}}
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('production.consult') }}" name="consultProduction" method="post">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col">
                        <select class="custom-select" name="month" id="month">
                            @foreach(\App\Helpers\Date::allMonths() as $key => $month)
                                <option value="{{$key + 1}}"
                                    {{ $key+1 == (($monthSelected ?? '') ? $monthSelected : now()->month) ? 'selected' : ''}}>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select class="custom-select" name="year" id="year">
                            @foreach(\App\Helpers\Date::intervalYear(now()->year, '2020') as $year)
                                <option value="{{ $year }}"
                                    {{ ($year == ($yearSelected ?? '') ? 'selected' : '') }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SHOW PRODUCTION --}}
    <div class="card card-danger card-outline">
        <div class="card-body">
            <form action="{{ route('production.store') }}" name="storeProduction" method="post">
                @csrf
                <div class="table-responsive table-sm production">
                    <table class="table table-hover" id="productionTable">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Dia</th>
                            <th scope="col">IMÓVEIS CAPTADOS</th>
                            <th scope="col">EXCLUSIVIDADES CAPTADAS</th>
                            <th scope="col">ANÚNCIOS PUBLICADOS</th>
                            <th scope="col">PLACAS</th>
                            <th scope="col">PROPOSTAS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($monthProductions as $date => $production)
                            <tr>
                                <th scope="row">{{ date('d/m/Y', strtotime($date)) }}</th>
                                <td>
                                    <input type="number" min="0" name="prod[{{$date}}][imv_cap]"
                                           value="{{ $production->captured_properties ?? '0' }}">
                                </td>
                                <td>
                                    <input type="number" min="0" name="prod[{{$date}}][exc_cap]"
                                           value="{{ $production->captured_exclusivities ?? '0' }}">
                                </td>
                                <td>
                                    <input type="number" min="0" name="prod[{{$date}}][anuncios_publicados]"
                                           value="{{ $production->published_ads ?? '0' }}">
                                </td>
                                <td>
                                    <input type="number" min="0" name="prod[{{$date}}][placas]"
                                           value="{{ $production->plaques ?? '0' }}">
                                </td>
                                <td>
                                    <input type="number" min="0" name="prod[{{$date}}][propostas]"
                                           value="{{ $production->proposals ?? '0' }}">
                                </td>

                                <input type="hidden" name="prod[{{$date}}][date]" value="{{$date}}">
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-success btn-floating"
                            data-toggle="tooltip"
                            data-placement="left"
                            title="Salvar produção">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay dark" style="display: none;">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <!-- end loading -->
    </div>

@endsection

@section('js')
    <!-- InputMask -->
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/input-masks.js') }}"></script>


    {{-- floatThead --}}
    <script src="{{ asset('js/jquery.floatThead.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('table#productionTable').floatThead({
                responsiveContainer: function ($table) {
                    return $table.closest('.table-responsive');
                },
                position: 'fixed',
                scrollingTop: 65
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });

            //Ativa o loading
            $('form').submit(function () {
                $('.overlay').show();
            });
        });
    </script>
@endsection
