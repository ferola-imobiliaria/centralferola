@extends('layouts.master')

@section('page_title', 'Usuário')
@section('page_subtitle', 'editar informações')

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
                        <form method="POST" action="{{ route('user.update', ['user' => $user->uuid]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="name">Nome completo</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ $user->name }}">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="name_short">Nome que gostaria de ser chamado</label>
                                    <input type="text" name="name_short" id="name_short"
                                           class="form-control @error('name_short') is-invalid @enderror"
                                           value="{{ $user->name_short }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ $user->email }}"
                                           readonly>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="cpf">CPF</label>
                                    <input type="text" name="cpf" id="cpf"
                                           class="form-control maskCpf @error('cpf') is-invalid @enderror"
                                           placeholder="CPF" value="{{ $user->cpf}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="creci"> CRECI</label>
                                    <input type="text" name="creci" id="creci"
                                           class="form-control @error('creci') is-invalid @enderror" placeholder="CRECI"
                                           value="{{ $user->creci }}">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="phone">Telefone</label>
                                    <input type="text" name="phone" id="phone"
                                           class="form-control maskCellPhone @error('phone') is-invalid @enderror"
                                           value="{{ $user->phone }}">
                                </div>
                            </div>

                            {{-- Team Realtor --}}
                            <div class="form-row">
                                @canany('is-admin')
                                    @if($user->profile != 'admin')
                                        <div class="form-group col-md-6 col-sm-12 mb-3">
                                            <label for="realtor_team">Equipe</label>
                                            <select class="custom-select" name="realtor_team" id="realtor_team">
                                                @foreach($teams as $team)
                                                    <option
                                                        value="{{ $team->id }}" {{ ($user->team->id == $team->id ? 'selected' : '' ) }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endcanany
                                {{-- END Team Realtor --}}
                                <div class="col-md-6 col-sm-12">
                                    <label for="phone">Perfil</label>
                                    <select class="custom-select" name="profile" id="profile">
                                        @if($user->profile == 'realtor')
                                            <option value="realtor" selected>Corretor</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="admin">Administrador</option>
                                        @elseif($user->profile == 'supervisor')
                                            <option value="supervisor" selected>Supervisor</option>
                                            <option value="realtor">Corretor</option>
                                            <option value="admin">Administrador</option>
                                        @elseif($user->profile == 'admin')
                                            <option value="admin" selected>Administrador</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="realtor">Corretor</option>
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col mb-3 mt-3">
                                    <input type="file" class="dropify"
                                           name="photo" id="photo"
                                           data-max-file-size="1M"
                                           data-allowed-file-extensions="jpg png jpeg"
                                           data-default-file="{{ url('storage') }}/{{ $user->photo }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-success">
                                    Atualizar <i class="fas fa-sync ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
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

    <!-- Add Input Area -->
    <script src="{{ asset('js/jquery.add-input-area.js') }}"></script>

    <!-- Register script -->
    <script src="{{ asset('js/register.js') }}"></script>

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
    </script>
@endsection

