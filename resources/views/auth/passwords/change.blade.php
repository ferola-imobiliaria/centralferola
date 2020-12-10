@extends('layouts.master')

@section('page_title', 'Trocar senha')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                @include('components.errors')
                <div class="card card-danger card-outline">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.change.password', Auth::user()->uuid) }}">
                            @csrf
                            @method('PUT')

                            <div class="input-group mb-3">
                                <input type="password" name="current_pass" class="form-control"
                                       placeholder="Senha atual" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="new_pass" class="form-control" placeholder="Nova senha"
                                       required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="check_pass" class="form-control"
                                       placeholder="Confirmação de senha" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary float-right">
                                Alterar senha
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
