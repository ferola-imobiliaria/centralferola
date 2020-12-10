@extends('layouts.master')

@section('page_title', 'Equipes')

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-body">
            <div class="card-columns">
                @foreach($teams as $team)
                    <div class="card">
                        <div class="card-header bg-gray-light">
                            <h3 class="card-title">{{ $team->name }}</h3>
                            <!-- trigger modal -->
                            <a href="#" class="ml-2" data-toggle="modal" data-target="#editTeam"
                               data-id="{{ $team->id }}"
                               data-team-name="{{ $team->name }}"
                               data-team-store="{{ $team->store }}">
                                <i class="far fa-edit"></i>
                            </a>
                            <div class="card-tools">
                                <span
                                    class="badge badge-{{ storeColors($team->store, "colorName") }}"> {{ ucfirst(__($team->store)) }}</span>
                                <span class="badge badge-warning"> {{ $team->users->count() }} corretores</span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 shadow rounded">
                            <ul class="users-list">
                                @foreach($team->users as $member)
                                    <li class="col-sm-4">
                                        <img
                                            src="{{ asset('storage/' . ($member->photo ?? '../images/no_photo.png')) }}"
                                            alt="{{ $member->name_short }}">
                                        <a class="users-list-name" href="#">{{ $member->name_short }}</a>
                                        <span class="users-list-date">{{ $member->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editTeam" tabindex="-1" role="dialog" aria-labelledby="editTeamTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Equipe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formEditTeam" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nome da equipe</label>
                                <input type="text" class="form-control" name="name" id="name" value="nome da equipe">
                            </div>

                            <div class="form-group">
                                <label for="store">Loja</label>
                                <select class="form-control custom-select" name="store" id="store">
                                    <option value="sede">Sede</option>
                                    <option value="aguas_claras">Águas Claras</option>
                                    <option value="noroeste">Noroeste</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="formSubmit" class="btn btn-outline-success">Save alterações</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script>
                $('#editTeam').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var teamName = button.data('team-name')
                    var modal = $(this)
                    modal.find('.modal-title').text('Editar Equipe - ' + teamName)
                    modal.find('.modal-body input#name').val(teamName)

                    // ativando o selected na loja do time
                    var teamStore = button.data('team-store')
                    $("#store option").each(function () {
                        if (teamStore == this.value) {
                            $(this).attr('selected', 'true');
                        }
                    });

                    //Montar a rota de atualização na modal
                    var id = button.data('id');
                    var url = '{{ route("team.update", ":id") }}';
                    url = url.replace(':id', id);
                    $("#formEditTeam").attr('action', url);

                    // Submit formulário de atualização
                    $("#formSubmit").click(function () {
                        $("#formEditTeam").submit();
                    });
                })
            </script>
@endsection
