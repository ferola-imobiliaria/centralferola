@extends('layouts.master')

@section('page_title', 'Controle de Comissões')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
@endsection

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-header">
            @cannot('is-admin')
                <div class="row">
                    <div class="col mb-3 text-right">
                        <a href="{{ route('commissions-control.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle mr-2"></i> Novo
                        </a>
                    </div>
                </div>
            @endcannot
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" style="width:100%" id="tableCommissionsControls">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    @can('is-admin-or-supervisor')
                        <th scope="col">Corretor</th>
                    @endcan
                    <th scope="col">Proprietário</th>
                    <th scope="col">End. do imóvel</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Data da venda</th>
                    <th scope="col">Valor de venda (R$)</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($commissionsControls as $commission)
                    <tr>
                        <td>{{ $commission->id }}</td>
                        @can('is-admin-or-supervisor')
                            <td>
                                {{ $commission->user->name_short }}
                                @can('is-admin')
                                    <small>({{ $commission->user->team->name }})</small>
                                @endcan
                            </td>
                        @endcan
                        <td>{{ $commission->owner }}</td>
                        <td>{{ $commission->property }}</td>
                        <td>{{ $commission->owner_cpf }}</td>
                        <td>{{ $commission->sale_date }}</td>
                        <td>{{ number_format($commission->sale_value, 2, ',', '.') }}</td>

                        <td class="text-right">
                            <ul class="list-inline d-flex">
                                <li class="list-inline-item">
                                    <a href="{{ route('commissions-control.edit', $commission->uuid ) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-user-edit" data-toggle="tooltip" data-placement="top"
                                           title="Editar"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('commissions-control.show', $commission->uuid) }}"
                                       class="btn btn-outline-secondary btn-sm" target="_new">
                                        <i class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top"
                                           title="Ver PDF"></i>
                                    </a>
                                </li>
                                @can('is-admin-or-supervisor')
                                    <li class="list-inline-item">
                                        <a href="" class="btn btn-outline-danger btn-sm"
                                           data-toggle="modal"
                                           data-target="#deleteCommissionControl"
                                           data-id="{{ $commission->id }}"
                                           onclick="destroyCommissionControl('{{ $commission->uuid }}')">
                                            <i class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                                               title="Excluir"></i>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @can('is-admin-or-supervisor')
        <!-- Modal - Excluir Controle de Comissão -->
        <div class="modal fade" id="deleteCommissionControl" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Excluir Controle de Comissão</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            <b>Você tem certeza que deseja excluir o Controle de Comissão #<span
                                    id="idCommission"></span>?</b>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="" id="formDestroyControlCommission" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal"><b>Não</b></button>
                            <button type="submit" class="btn btn-outline-light">Sim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('js/dataTables.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip()

            $('#tableCommissionsControls').DataTable({
                "order": [[0, "desc"]],
                "ordering": true,
                responsive: true,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum recibo encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                }
            });
        });

        $('#deleteCommissionControl').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data("id") // Extract info from data-* attributes
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#idCommission').text(id)
        })

        function destroyCommissionControl(uuid) {
            var uuid = uuid;
            var url = '{{ route("commissions-control.destroy", ":uuid") }}';
            url = url.replace(':uuid', uuid);
            $("#formDestroyControlCommission").attr('action', url);
        }
    </script>
@endsection
