@extends('layouts.master')

@section('page_title', 'Controle de Comissões')
@section('page_subtitle', 'editar')

<style>
    /* Remover setas do input number - Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Remover setas do input number - Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('components.errors')
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col mb-3 text-right">
                                <a href="{{ route('commissions-control.index') }}" class="btn btn-primary">
                                    <i class="fas fa-eye mr-2"></i> Ver todos
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <small>
                                <i class="icon fas fa-exclamation-triangle"></i>
                                Caso queira alterar alguma informação do Controle de Comissão, que não esteja abaixo,
                                solicite ao seu supervisor.
                            </small>
                        </div>

                        <hr>

                        <form action="{{ route('commissions-control.update', $commission_control->uuid) }}"
                              method="post">
                            @csrf
                            @method('PUT')

                            <div class="bg-gray-light p-2">
                                <span class="bg-gray-100">Loja: <b class="ml-2">{{ __($commission_control->store) }}</b></span>
                            </div>

                            <br>

                            <div class="form-row">
                                <div class="form-group col-sm-12 col-md-8">
                                    <label for="property">Imóvel</label>
                                    <input type="text" class="form-control" name="property" id="property"
                                           value="{{ $commission_control->property }}" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="edifice">Edifício</label>
                                    <input type="text" class="form-control" name="edifice" id="edifice"
                                           value="{{ $commission_control->edifice }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="owner">Proprietário</label> <small>(os dados do Proprietário servirão
                                        para gerar o recibo)</small>
                                    <input type="text" class="form-control" name="owner" id="owner" maxlength="40"
                                           value="{{ $commission_control->owner }}" required>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="owner_cpf">CPF</label>
                                    <input type="text" class="form-control maskCpf" name="owner_cpf" id="owner_cpf"
                                           value="{{ $commission_control->owner_cpf }}" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="owner_phone">Telefone</label>
                                    <input type="text" class="form-control maskCellPhone" name="owner_phone"
                                           id="owner_phone"
                                           value="{{ $commission_control->owner_phone }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-3 col-sm-12">
                                    <label for="sale_date">Data da venda</label>
                                    <input type="text" class="form-control" id="sale_date"
                                           value="{{ $commission_control->sale_date }}" readonly>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="sale_value">Valor da venda</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{ number_format($commission_control->sale_value, 2, ',', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="commission_percentage">% Comissão</label>
                                    <div class="input-group mb-3 input-percentage">
                                        <input type="text" class="form-control"
                                               value="{{ $commission_control->commission_percentage }}"
                                               readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-percentage"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="commission_value">R$ Comissão</label>
                                    <div class="input-group input-commission">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{ number_format($commission_control->commission_value, 2, ',', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-7 col-sm-12">
                                    <label for="realtor">Corretor</label>
                                    <input type="text" class="form-control"
                                           value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="realtor_percentage">Porcentagem</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               value="{{ $commission_control->realtor_percentage }}"
                                               readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-percentage"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="realtor_commission">Valor da comissão</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{ number_format($commission_control->realtor_commission, 2, ',', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-7 col-sm-12">
                                    <label for="catcher">Captador</label>
                                    <input type="text" class="form-control"
                                           value="{{ getUserName($commission_control->catcher) }}"
                                           readonly>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="catcher_percentage">Porcentagem</label>
                                    <div class="input-group">
                                        <input type="number" value="10" class="form-control" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-percentage"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="catcher_commission">Valor da comissão</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{ number_format($commission_control->catcher_commission, 2, ',', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>


                            @isset($commission_control->exclusive)
                                <div class="form-row mb-3">
                                    <div class="col-md-7 col-sm-12">
                                        <label for="catcher">Exclusivo</label>
                                        <input type="text" class="form-control"
                                               value="{{ getUserName($commission_control->exclusive) }}"
                                               readonly>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <label for="catcher_percentage">Porcentagem</label>
                                        <div class="input-group">
                                            <input type="number" value="10" class="form-control" readonly>
                                            <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-percentage"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label for="catcher_commission">Valor da comissão</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control"
                                                   value="{{ number_format($commission_control->exclusive_commission, 2, ',', '.') }}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($commission_control->supervisor)
                            <div class="form-row">
                                <div class="col-md-7 col-sm-12">
                                    <label for="supervisor">Supervisor</label>
                                    <input type="text" class="form-control"
                                           value="{{ getUserName($commission_control->supervisor) }}" readonly>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="supervisor_percentage">Porcentagem</label>
                                    <div class="input-group">
                                        <input type="text" value="5" class="form-control" readonly>
                                        <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-percentage"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="supervisor_commission">Valor da comissão</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{ number_format($commission_control->supervisor_commission, 2, ',', '.') }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            @endisset

                            <hr>

                            <div style="display:flex; align-items:center;">
                                <label class="mr-2">Imobiliária:</label>
                                <div class="input-group col-md-4 col-sm-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <b>R$</b>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control"
                                           value="{{ number_format($commission_control->real_estate_commission, 2, ',', '.') }}"
                                           readonly>
                                </div>
                            </div>

                            <hr>

                            <button class="btn btn-success btn-floating"
                                    data-toggle="tooltip"
                                    data-placement="left"
                                    title="Editar Controle de Comissão"
                                    type="submit">
                                <i class="fas fa-edit"></i>
                            </button>
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
@endsection
