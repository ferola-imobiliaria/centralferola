<!-- Consult -->
<div class="card card-outline">
    <div class="card-body">
        <form action="{{ route('report.team.production.show') }}" method="post">
            @csrf

            <div class="row">
                @can('is-admin')
                    <div class="form-group col-sm">
                        <select class="form-control select2bs4" name="team" id="team" style="width: 100%;">
                            <option value="">» Equipe «</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}"
                                    {{ $team->id == ($teamSelected->id ?? '') ? 'selected' : ''}}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endcan
                <div class="form-group col-sm">
                    <select class="custom-select" name="month" id="month">
                        @foreach(\App\Helpers\Date::allMonths() as $key => $month)
                            <option value="{{$key + 1}}"
                                {{ $key+1 == (($monthSelected ?? '') ? $monthSelected : now()->month) ? 'selected' : ''}}>
                                {{ $month }}
                            </option>
                        @endforeach
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

<!-- Production Result -->

@isset($teamProduction)
    <div class="card card-danger card-outline">
        <div class="card-header">
            <h4><b> {{ $teamSelected->name }} - {{ $monthSelected }}/{{ $yearSelected }}</b></h4>
        </div>
        <div class="card-body table-responsive p-0" id="card-production-team">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width: 160px;">Corretor</th>
                    <th scope="col" class="text-center">Imóveis captados</th>
                    <th scope="col" class="text-center">Exclusividades captadas</th>
                    <th scope="col" class="text-center">Anúncios publicados</th>
                    <th scope="col" class="text-center">Placas</th>
                    <th scope="col" class="text-center">Propostas</th>
                    <th scope="col" class="text-center">Vendas</th>
                    <th scope="col" class="text-center">VGV (R$)</th>
                    <th scope="col" class="text-center">Exclusividades vendidas</th>
                    <th scope="col" class="text-center">Captações vendidas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teamProduction as $name => $production)
                    <tr>
                        <th scope="row">{{ $name }}</th>
                        <td class="text-center">{{ $production->captured_properties ?? 0 }}</td>
                        <td class="text-center">{{ $production->captured_exclusivities ?? 0 }}</td>
                        <td class="text-center">{{ $production->published_ads ?? 0 }}</td>
                        <td class="text-center">{{ $production->plaques ?? 0 }}</td>
                        <td class="text-center">{{ $production->proposals ?? 0 }}</td>
                        <td class="text-center">{{ $production->sales ?? 0 }}</td>
                        <td class="text-center">{{ number_format($production->vgv, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $production->exclusivities_sold ?? 0 }}</td>
                        <td class="text-center">{{ $production->captures_sold ?? 0 }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-2 text-right border-top" id="print-production-team">
            <button class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-print"></i> Imprimir
            </button>
        </div>
    </div>
@endisset
