@extends('layouts.master')

@section('page_title', 'Usuários')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
@endsection

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col mb-3 text-right">
                    <a href="{{ route('register') }}" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Novo usuário
                    </a>
                    <a href="{{ route('user.trashed') }}" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Lixeira
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" style="width:100%" id="tableUsers">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CRECI</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Último acesso</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    {{-- Condição para que não seja exibido as informações do próprio usuário --}}
                    @if($user->id != Auth::id())
                        <tr>
                            <td>
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                         src="{{ asset('storage/' . ($user->photo ?? '../images/no_photo.png')) }}">
                                    <span class="username">
                                        {{ $user->name_short }} <small>({{ $user->name }})</small>
                                    </span>
                                    <p class="description">
                                        Equipe: <span
                                            class="badge badge-{{ storeColors($user->team->store, "colorName") }}">{{ $user->team->name ?? '' }}</span>
                                    </p>

                                </div>
                            </td>
                            <td>{{ $user->cpf }}</td>
                            <td>{{ $user->creci }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ ucfirst(__($user->profile)) }}</td>
                            <td>{{ $user->last_login_at }}</td>
                            <td class="text-right">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('user.edit', $user->uuid) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-user-edit"></i> Editar
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="btn btn-outline-danger btn-sm"
                                           data-toggle="modal"
                                           data-target="#deleteUser"
                                           onclick="destroyUser('{{ $user->uuid }}')">
                                            <i class="fas fa-user-times"></i> Excluir
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal - Excluir usuário -->
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Excluir usuário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>Você tem certeza que deseja excluir este usuário?</b></p>
                </div>
                <div class="modal-footer">
                    <form action="" id="formDestroyUser" class="" method="POST">
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
    <!-- FIM - Modal - Excluir usuário -->
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('js/dataTables.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tableUsers').DataTable();
        });


        $('#tableUsers').DataTable({
            "order": [[0, "desc"]],
            "ordering": false,
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
    </script>

    <script>
        function destroyUser(uuid) {
            var uuid = uuid;
            var url = '{{ route("user.destroy", ":uuid") }}';
            url = url.replace(':uuid', uuid);
            $("#formDestroyUser").attr('action', url);
        }
    </script>
@endsection
