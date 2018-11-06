@extends("painel.templates.app")
@section('content')
    <div class="container">
        <div class="row">

            <section class="content-header">
                <h1>
                    Gerenciar Documentos Eventos
                </h1>
            </section>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <section class="content">
                <div class="col-md-12">
                        <a href="javascript:;"
                           class="btn btn-primary btn-lg btn-upload-multiplo-modal margin-bottom"
                           data-href="{{url("painel")}}/eventos/{{Route::input('id_eve')}}/multiploupload" data-multiplo="true">
                            <i class="fa fa-upload"></i>&nbsp;Enviar Arquivos
                        </a>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="with-border"></div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-12 table-responsive" style="min-height: 300px;">
                                <table class="table table-bordered table-hover" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th class="col-sm-3 text-center">Doc</th>
                                        <th class="col-sm-8">Título</th>
                                        <th class="col-sm-1 text-center">#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count(@$itens) > 0)
                                        @foreach($itens as $item)
                                            <tr>
                                                <td style="vertical-align: middle">
                                                    <a href="{{asset("upload/documentos/".$item->DocArquivo)}}"
                                                       class="btn cor2-bg branco btn-sm center-block" target="_blank">
                                                        <i class="fa fa-file-pdf-o fa-2x"></i> {{$item->DocTitulo}}
                                                    </a>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <div class="form-group form{{$item->DocCodigo}}">
                                                        <input type="text" class="form-control legenda" maxlength="300"
                                                               value="{{$item->DocTitulo}}" name="legenda" id="legenda"
                                                               data-id="{{$item->DocCodigo}}"
                                                               data-href="{{url('painel')}}/eventos/{{Route::input('id_eve')}}/documentos/{{$item->DocCodigo}}/legenda">
                                                        <span class="help-block span{{$item->DocCodigo}} hidden"></span>
                                                    </div>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a href="{{url('painel')}}/eventos/{{Route::input('id_eve')}}/documentos/{{$item->DocCodigo}}/destroy"
                                                       class="btn btn-danger btn-sm btn-destroy"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">
                                                Nenhum Registro Encontrado
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection