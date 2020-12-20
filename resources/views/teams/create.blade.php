@extends('layouts.master')

@section('page_title', 'Equipes')
@section('page_subtitle', 'Criar')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="col-6 offset-3">
        <div class="card card-danger card-outline">
            <div class="card-body">
                <form action="{{ route('team.store')  }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome da equipe</label>
                        <input type="text" class="form-control" name="name" id="name" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="supervisor">Supervisor</label>
                        <select class="form-control select2" name="supervisor" id="supervisor"
                                data-placeholder="Selecione o supervidor da equipe" required>
                            <option></option>
                            @foreach($realtors as $realtor)
                                <option value="{{ $realtor->id }}">
                                    {{ $realtor->name }} ({{ $realtor->name_short }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="store">Loja</label>
                        <select class="form-control select2" name="store" id="store"
                                data-placeholder="Selecione a Loja" required>
                            <option></option>
                            <option value="sede">Sede</option>
                            <option value="aguas_claras">Águas Claras</option>
                            <option value="noroeste">Noroeste</option>
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar equipe
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
    </div>
@endsection

@section('js')

    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $(function () {
                //Initialize Select2 Elements
                $('select').select2({
                    theme: "bootstrap",
                    placeholder: function () {
                        $(this).data('placeholder');
                    }
                })
            });
        });

        //Ativa o loading
        $('form').submit(function () {
            $('.overlay').show();
        });
    </script>
@endsection
