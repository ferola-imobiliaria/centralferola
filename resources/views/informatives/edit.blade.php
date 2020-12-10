@extends('layouts.master')

@section('page_title', 'Informativos')
@section('page_subtitle', 'editar')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col mb-3 text-right">
                    <a href="{{ route('informative.index') }}" class="btn btn-info">
                        <i class="fas fa-eye mr-2"></i> Ver todos
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('informative.update', $informative->id) }}" method="post" id="formEditInformative"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="box-body">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" class="form-control"
                               value="{{ $informative->title }}"
                               autofocus>
                    </div>
                    <div class="form-group">
                        <label for="editor">Conteúdo</label>
                        <textarea name="contentInformative" id="summernote">
                            {{$informative->content}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="doc">Documento</label>
                        <input type="file" name="doc" id="doc" class="dropify"
                               data-max-file-size="3M" data-allowed-file-extensions="doc docx pdf" data-height="150"
                               data-default-file="{{ Storage::url($informative->doc) }}"
                        />
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="published" {{ ($informative->published ? 'checked' : '') }}>
                                <b>Publicado</b>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('informative.index') }}" class="btn btn-default margin-r-5">voltar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-sync mr-1"></i> Atualizar
                    </button>
                </div>
            </form>
        </div>
        <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay dark" style="display: none">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <!-- end loading -->
    </div>
@endsection

@section('js')
    <script src="{{asset('js/summernote-bs4.js')}}"></script>
    <script src="{{asset('js/summernote-pt-BR.js')}}"></script>
    <script src="{{ asset('js/dropify.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#summernote').summernote({
                lang: 'pt-BR',
                height: 250
            });

            $('.dropify').dropify({
                error: {
                    'fileSize': 'O tamanho do arquivo é muito grande (\{\{ value \}\} máx).',
                    'imageFormat': 'O formato do arquivo não é permitido (\{\{ value \}\} somente).'
                },
                messages: {
                    'default': 'Arraste e solte ou clique aqui para inserir um arquivo',
                    'replace': 'Arraste e solte ou clique para substituir o arquivo',
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
