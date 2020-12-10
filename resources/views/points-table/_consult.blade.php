<div class="card card-danger card-outline">
    <div class="card-body">
        <form action="{{ route('points-table.show') }}" name="consultPointsTable" method="post">
            @csrf

            <div class="row align-items-center">
                @can('is-admin-or-supervisor')
                    <div class="col-sm">
                        <select class="form-control select2bs4" name="realtor" id="realtor" style="width: 100%;">
                            <option value="" selected>» Corretor «</option>
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
                <div class="col-sm">
                    <select class="custom-select" name="quarter" id="quarter">
                        <option value="1" @if($quarter == 1) selected @endif>1º trimestre</option>
                        <option value="2" @if($quarter == 2) selected @endif>2º trimestre</option>
                        <option value="3" @if($quarter == 3) selected @endif>3º trimestre</option>
                        <option value="4" @if($quarter == 4) selected @endif>4º trimestre</option>
                    </select>
                </div>
                <div class="col-sm">
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
