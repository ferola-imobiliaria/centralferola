@extends('layouts.master')

@section('page_title', 'Usuário')
@section('page_subtitle', 'novo cadastro')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dropify.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('components.errors')
                <div class="card card-danger card-outline">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="name" placeholder="Nome completo"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-tie"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="name_short"
                                           class="form-control @error('name_short') is-invalid @enderror"
                                           placeholder="Nome que gostaria de ser chamado"
                                           value="{{ old('name_short') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="E-mail"
                                           value="{{ old('email') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>@ferola.com.br</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="cpf"
                                           class="form-control maskCpfNoPlaceHolder @error('cpf') is-invalid @enderror"
                                           placeholder="CPF" value="{{ old('cpf') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="creci"
                                           class="form-control @error('creci') is-invalid @enderror" placeholder="CRECI"
                                           value="{{ old('creci') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-badge"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group col-md-6 col-sm-12 mb-3">
                                    <input type="text" name="phone" class="form-control maskCellPhone"
                                           placeholder="Telefone" value="{{ old('phone') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @can('is-admin')
                                <div class="form-row">
                                    <div class="input-group col-md-6 col-sm-12 mb-1">
                                        <select class="custom-select @error('profile') is-invalid @enderror"
                                                name="profile">
                                            <option value="" selected hidden>» Selecione o perfil «</option>
                                            <option value="realtor">Corretor</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="admin">Administrador</option>
                                        </select>
                                    </div>

                                    {{-- Team Realtor --}}
                                    <div class="input-group col-md-6 col-sm-12 mb-3">
                                        <select class="custom-select d-none" name="realtor_team">
                                            <option value="" selected>» Selecione a equipe «</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- END Team Realtor --}}
                                </div>

                                {{-- Team Supervisor --}}
                                <div class="d-none" id="team">
                                    <div class="form-row mt-2 team_var">
                                        <div class="input-group col-7">
                                            <input type="text" name="team_name" class="form-control"
                                                   placeholder="Nome da equipe">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group col-5">
                                            <select class="custom-select" name="team_store">
                                                <option selected hidden>» Selecione a Loja «</option>
                                                <option value="sede">Sede</option>
                                                <option value="aguas_claras">Águas Claras</option>
                                                <option value="noroeste">Noroeste</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- END Team Supervisor --}}
                            @endcan

                            <div class="input-group mb-3 mt-3">
                                <input type="file" class="dropify"
                                       name="profile_picture" id="profile_picture"
                                       data-max-file-size="1M"
                                       data-allowed-file-extensions="jpg png jpeg"/>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
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
        </div>

    </div>
@endsection

@section('js')

    <!-- InputMask -->
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/input-masks.js') }}"></script>

    <!-- Dropify -->
    <script src="{{ asset('js/dropify.js') }}"></script>

    <!-- Register script -->
    @can('is-admin')
        <script src="{{ asset('js/register.js') }}"></script>
    @endcan

    <script>
        $(document).ready(function () {
            // Dropify - Utilizado para selecionar a foto do perfil
            $('.dropify').dropify({
                error: {
                    'fileSize': 'O tamanho do arquivo é muito grande. Máx. permitido: 1M).',
                    'imageFormat': 'O formato da imagem não é permitido. Selecione uma imagem png, jpg ou jpeg).'
                },
                messages: {
                    'default': 'Arraste e solte ou clique aqui para inserir a foto',
                    'replace': 'Arraste e solte ou clique para substituir a foto',
                    'remove': 'Remover',
                    'error': 'Ooops, algo errado aconteceu.'
                }
            });
        });

        //Ativa o loading
        $('form').submit(function () {
            $('.overlay').show();
        });
    </script>
@endsection
