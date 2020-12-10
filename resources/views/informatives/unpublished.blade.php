@extends('layouts.master')

@section('page_title', 'Informativos')
@section('page_subtitle', 'não publicados')


@section('content')

    <div class="card card-danger card-outline">
        <div class="card-header">
            @can('is-admin-or-supervisor')
                <div class="row">
                    <div class="col mb-3 text-right">
                        <a href="{{ route('informative.index') }}" class="btn btn-info">
                            <i class="fas fa-eye mr-1"></i> Publicados
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        @if(count($informatives) > 0)
            <div class="card-body">
                @foreach($informatives as $informative)
                    @if(!$informative->published)
                        <div class="callout callout-info">
                            @can('is-admin-or-supervisor')
                                <div class="informative-tools float-right">
                                    <a href="{{ route('informative.edit', $informative->id) }}"
                                       class="mr-1"
                                       data-toggle="tooltip"
                                       data-placement="left"
                                       title="Editar informativo">
                                        <i class="fas fa-edit text-primary"></i>
                                    </a>
                                    <a href="#"
                                       onclick="removeInformative({{$informative->id}}, '{{$informative->title}}')"
                                       class="ml-1"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Excluir informativo">
                                        <i class="fas fa-trash-alt text-red"></i>
                                    </a>
                                </div>
                            @endcan

                            <h4 class="informative-title">{{ $informative->title }}</h4>

                            <div class="informative-content">
                                {!! html_entity_decode($informative->content) !!}
                            </div>

                            <div class="informative-footer row">
                                <div class="col">
                                    <small class="text-muted">
                                        <b>Autor:</b> {{ $informative->user->name_short }} |
                                        <b>atualizado
                                            em:</b> {{ $informative->updated_at->format('d/m/Y \à\s H\hi') }}
                                    </small>
                                </div>
                                @if($informative->doc)
                                    <div class="col text-right">
                                        <a href="{{ Storage::url($informative->doc)  }}"
                                           class="text-sm btn btn-default btn-sm"
                                           target="_new">
                                            <i class="fa fa-download mr-2"></i> {{ basename($informative->doc) }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <h4 class="text-center p-5">Nenhum informativo despublicado.</h4>
        @endif
    </div>


    <!-- Modal -->
    <div class="modal modal-danger fade in" id="removeInformativeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="formDestroyInformative" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Excluir informativo</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente exluir o informativo: <b class="title-destroy"></b></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-outline">Ok</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@push('javascript')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })

        function removeInformative(id, title) {
            var id = id;
            var url = '{{ route("informative.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#formDestroyInformative").attr('action', url);

            $('.title-destroy').html(title);

            $('#removeInformativeModal').modal();
        }
    </script>
@endpush
