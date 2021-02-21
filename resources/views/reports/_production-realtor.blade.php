<!-- Consult -->
<div class="card card-outline">
    <div class="card-body">
        <form action="{{ route('report.production.show') }}" method="post">
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
@isset($userProduction)
    <div class="card card-danger card-outline">
        <div class="card-body">
            <div class="row">
                @foreach($userProduction as $key => $production)
                    <div class="col-sm">
                        <div class="card card-danger text-center elevation-2">
                            <div class="card-header d-flex align-items-center" style="height: 65px;">
                                <h3 class="card-title">{{ __($key) }}</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="text-bold @if($key == 'vgv') maskMoney @endif">{{ $production ?? 0 }}</h4>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endisset

<!-- Production Detail -->
@isset($dayUserProduction)
    <div class="card card-danger collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Produção diária</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: none;">
            @can('is-supervisor')
                @isset($dayUserProduction)
                    <div class="table-responsive table-sm production">
                        <table class="table table-striped table-hover" id="productionTable">
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
                            @foreach($dayUserProduction as $production)
                                <tr>
                                    <th scope="row">{{ date('d/m/Y', strtotime($production->date)) }}</th>
                                    <td>{{ $production->captured_properties }}</td>
                                    <td>{{ $production->captured_exclusivities }}</td>
                                    <td>{{ $production->published_ads }}</td>
                                    <td>{{ $production->plaques }}</td>
                                    <td>{{ $production->proposals }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endisset
            @endcan
        </div>
        <!-- /.card-body -->
    </div>
@endisset
