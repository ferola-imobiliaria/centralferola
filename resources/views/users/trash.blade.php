@extends('layouts.master')

@section('page_title', 'Usuários')
@section('page_subtitle', 'lixeira')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
@endsection

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col mb-3 text-right">
                    <a href="{{ route('user.index') }}" class="btn btn-info">
                        <i class="fas fa-users"></i> Ver usuários
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" style="width:100%" id="usersTrashed">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Equipe</th>
                        <th scope="col">CRECI</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Perfil</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersTrashed as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                <span>{{ $user->team->name }}</span>
                            </td>
                            <td>{{ $user->creci }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ __($user->profile) }}</td>
                            <td class="text-right">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('user.restore', $user->uuid) }}"
                                           class="btn btn-outline-success"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="Reativar usuário"
                                        >
                                            <i class="fas fa-trash-restore-alt"></i> Restaurar
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-outline-danger"
                                           data-toggle="modal"
                                           data-target="#deleteUser"
                                           onclick="destroyPermanentlyUser('{{ $user->uuid }}')"
                                        >
                                            <i class="fas fa-trash"></i> Excluir
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal - Excluir permanentemente usuário -->
        <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Excluir usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p><b>Você tem certeza que deseja excluir este usuário?</b></p>
                        <small>Todas as informações relativas a este usuário serão removidas
                            definitivamente.</small>
                    </div>
                    <div class="modal-footer">
                        <form action="" id="formDestroyPermanentlyUser" class="" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                                <b>Não</b> <i class="fas fa-times ml-2"></i>
                            </button>
                            <button type="submit" class="btn btn-outline-light">
                                Sim <i class="fas fa-check ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIM - Modal - Excluir permanentemente usuário -->
    @endsection

    @section('js')
        <!-- DataTables -->
            <script src="{{ asset('js/dataTables.js') }}"></script>

            <script type="text/javascript">
                $(document).ready(function () {
                    // Init DataTable
                    $('#usersTrashed').DataTable();

                    // Init Tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                });

                function destroyPermanentlyUser(uuid) {
                    var uuid = uuid;
                    var url = '{{ route("user.destroyPermanently", ":uuid") }}';
                    url = url.replace(':uuid', uuid);
                    $("#formDestroyPermanentlyUser").attr('action', url);
                }

                $('#usersTrashed').DataTable({
                    "responsive": true,
                    "autoWidth": true,
                    "order": [[0, "desc"]],
                    "ordering": false,
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
            </script>
@endsection
