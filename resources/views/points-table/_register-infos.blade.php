<form action="{{ route('points-table.store.infos') }}" method="post" class="form-row">
    @csrf

    <input type="hidden" name="quarter" value="{{ $quarter }}">
    <input type="hidden" name="year" value="{{ $year }}">

    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header bg-danger">
                <h3 class="card-title">ENDEREÇO DAS PLACAS PENDURADAS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @for($i = 0; $i < $qtdFields['plaques']->value; $i++)
                    <div class="form-group">
                        <input type="text" class="form-control" name="plaque_address[{{$i}}][value]"
                               value="{{ $infos['plaque_address'][$i]->value ?? '' }}">
                        <input type="hidden" name="plaque_address[{{$i}}][id]"
                               value="{{ $infos['plaque_address'][$i]->id ?? '' }}">
                    </div>
                @endfor
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header bg-danger">
                <h3 class="card-title">CÓDIGOS DOS ANÚNCIOS PUBLICADOS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @for($i = 0; $i < $qtdFields['published_ads']->value; $i++)
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="published_ads[{{$i}}][value]"
                               value="{{ $infos['published_ads'][$i]->value ?? '' }}"
                        >
                        <input type="hidden" name="published_ads[{{$i}}][id]"
                               value="{{ $infos['published_ads'][$i]->id ?? '' }}">

                    </div>
                @endfor
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header bg-danger">
                <h3 class="card-title">ENDEREÇO DAS EXCLUSIVIDADES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @for($i = 0; $i < $qtdFields['exclusivities']->value; $i++)
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="exclusivity_address[{{$i}}][value]"
                               value="{{ $infos['exclusivity_address'][$i]->value ?? '' }}">
                        <input type="hidden" name="exclusivity_address[{{$i}}][id]"
                               value="{{ $infos['exclusivity_address'][$i]->id ?? '' }}">
                    </div>
                @endfor
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <button class="btn btn-success btn-floating"
            data-toggle="tooltip"
            data-placement="left"
            title="Salvar">
        <i class="fas fa-save"></i>
    </button>
</form>
