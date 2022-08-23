@extends('layouts.master')

@section('page_title', 'Controle de Comissões')

@section('style')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/>
@endsection


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
                                Todas as informações inseridas neste formulário serão conferidas pelo seu supervisor.
                            </small>
                        </div>
                        <hr>
                        <form action="{{ route('commissions-control.store') }}" method="post">
                            @csrf

                            <div class="bg-gray-light p-2">
                                <span class="bg-gray-100">Loja: <b class="ml-2">{{ __($user_store) }}</b></span>
                                <input type="hidden" name="store" value="{{ $user_store }}">
                            </div>

                            <br>

                            <div class="form-row">
                                <div class="form-group col-sm-12 col-md-8">
                                    <label for="property">Imóvel</label>
                                    <input type="text" class="form-control" name="property" id="property" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="edifice">Edifício</label>
                                    <input type="text" class="form-control" name="edifice" id="edifice">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="owner">Proprietário</label> <small>(os dados do Proprietário servirão
                                        para gerar o recibo)</small>
                                    <input type="text" class="form-control" name="owner" id="owner" maxlength="40"
                                           required>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="owner_cpf">CPF</label>
                                    <input type="text" class="form-control maskCpf" name="owner_cpf" id="owner_cpf"
                                           required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="owner_phone">Telefone</label>
                                    <input type="text" class="form-control maskCellPhone" name="owner_phone"
                                           id="owner_phone" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12">
                                    <div class="bg-gray form-group" style="padding: 5px">
                                        <div class="custom-control custom-checkbox" id="checkParceiro">
                                            <input class="custom-control-input" type="checkbox" id="isParceiro" name="isParceiro">
                                            <label for="isParceiro" class="custom-control-label">Venda feita com
                                                Parceiro?</label>

                                        </div>

                                        <div class="form-group row" id="divParceiro" style="display: none;">

                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="parceiro">Nome do Parceiro</label>
                                                <input type="text" class="form-control" name="nome_parceiro"
                                                       id="nome_parceiro">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="cpf_cnpj_parceiro">CPF / CNPJ do Parceiro</label>
                                                <input type="text" class="form-control" minlength="11" maxlength="18" name="cpf_cnpj_parceiro"
                                                       id="cpf_cnpj_parceiro">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="telefone_parceiro">Telefone do Parceiro</label>
                                                <input type="text" class="form-control maskCellPhone"
                                                       name="telefone_parceiro" id="telefone_parceiro">
                                            </div>
                                            <div class="col-md-3 col-sm-12 justify-content-center">
                                                <label for="sale_value_parceiro">Valor da comissão</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                                    </div>
                                                    <input type="text" class="form-control maskMoney2" name="sale_value_parceiro"
                                                           id="sale_value_parceiro">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-3 justify-content-center">
                                <div class="col-md-3 col-sm-12">
                                    <label for="sale_date">Data da venda</label>
                                    <input type="date" class="form-control" name="sale_date" id="sale_date"
                                           value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="sale_value">Valor da venda</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <b>R$</b>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control maskMoney2" name="sale_value"
                                               id="sale_value" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="commission_percentage">% Comissão</label>
                                    <div class="input-group mb-3 input-percentage">
                                        <input type="text" class="form-control" name="commission_percentage"
                                               id="commission_percentage"
                                               data-mask="0.00"
                                               data-mask-selectonfocus="true"
                                               readonly
                                        >
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
                                        <input type="text" class="form-control maskMoney2" name="commission_value"
                                               id="commission_value"
                                               readonly
                                        >
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">


                            </div>

                            <div class="form-row">
                                <div class="col-md-7 col-sm-12">
                                    <label for="realtor">Corretor</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="realtor_percentage">Porcentagem</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control maskPerc2"
                                               name="realtor_percentage"
                                               id="realtor_percentage"
                                               data-mask="00.00"
                                               data-mask-selectonfocus="true"
                                               required readonly
                                        >
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
                                        <input type="text" class="form-control maskMoney2"
                                               name="realtor_commission"
                                               id="realtor_commission"
                                               readonly
                                        >
                                    </div>
                                </div>
                            </div>


                            <div class="form-row mb-3">
                                <div class="col-md-7 col-sm-12">
                                    <label for="catcher">Captador</label>
                                    <select class="form-control select2" name="catcher" id="catcher" required>
                                        <option></option>
                                        @foreach($realtors as $realtor)
                                            <option value="{{ $realtor->id }}">
                                                {{ $realtor->name }} ({{ $realtor->name_short }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="catcher_percentage">Porcentagem</label>
                                    <div class="input-group">
                                        <input type="number" value="10" class="form-control" name="catcher_percentage"
                                               id="catcher_percentage"
                                               readonly>
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
                                               name="catcher_commission"
                                               id="catcher_commission"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12">
                                    <div class="bg-gray form-group" style="padding: 5px">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="isExclusive"
                                                   disabled>
                                            <label for="isExclusive" class="custom-control-label">Exclusivo?</label>
                                        </div>

                                        <div class="form-group row" id="divExclusive" style="display: none;">
                                            <div class="col-sm-7">
                                                <label for="exclusive">Exclusivo</label>
                                                <select class="form-control select2" name="exclusive" id="exclusive">
                                                    <option value=""></option>
                                                    @foreach($realtors as $realtor)
                                                        <option value="{{ $realtor->id }}">
                                                            {{ $realtor->name }} ({{ $realtor->name_short }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="exclusive_percentage">Porcentagem</label>
                                                <div class="input-group">
                                                    <input type="number" value="10" readonly class="form-control"
                                                           name="exclusive_percentage"
                                                           id="exclusive_percentage">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-percentage"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="exclusive_commission">Valor da comissão</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                          <b>R$</b>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                           name="exclusive_commission"
                                                           id="exclusive_commission"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @cannot('is-admin-or-supervisor')
                                <div class="form-row">
                                    <div class="col-md-7 col-sm-12">
                                        <label for="supervisor">Supervisor</label>
                                        <input type="text" class="form-control" value="{{ $supervisor->name }}"
                                               readonly>
                                        <input type="hidden" name="supervisor" value="{{ $supervisor->id }}">
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <label for="supervisor_percentage">Porcentagem</label>
                                        <div class="input-group">
                                            <input type="text" value="5" class="form-control"
                                                   name="supervisor_percentage"
                                                   id="supervisor_percentage"
                                                   readonly>
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
                                                   name="supervisor_commission"
                                                   id="supervisor_commission"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            @endcannot

                            <hr>

                            <div style="display:flex; align-items:center;">
                                <label class="mr-2">Imobiliária:</label>
                                <div class="input-group col-md-4 col-sm-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <b>R$</b>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="real_estate_commission"
                                           id="real_estate_commission" readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary pull-right"
                                       value="Registrar venda">
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

    <!-- SELECT 2 -->
    <script src="{{ asset('js/select2.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/input-masks.js') }}"></script>

    <!-- Script custom -->
    <script src="{{ asset('js/commissions-control.js') }}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('select.select2').select2({
                theme: "bootstrap",
                placeholder: "Selecione o corretor"
            });
        });

        //Ativa o loading
        $('form').submit(function () {
            $('.overlay').show();
        });
    </script>

@endsection
