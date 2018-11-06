@extends("painel.templates.app")
@section('content')
    <div class="container">
        <div class="row">

            <section class="content-header">
                <h1>
                    Editar Fotos Páginas
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('painel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{url('painel')}}/paginas"> Páginas</a></li>
                    <li><a href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos"> Fotos</a></li>
                    <li class="active">Editar</li>
                </ol>
            </section>

        </div>
    </div>

    <div class="container">
        <div class="row">

            <section class="content">
                <div class="col-sm-12">
                    <a data-href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos/multiploupload"
                       class="btn btn-primary btn-lg btn-upload-multiplo-modal margin-bottom" data-multiplo="true">
                        <i class="fa fa-plus"></i> Adicionar Fotos
                    </a>
                </div>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="with-border"></div>
                        <!-- /.box-header -->
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
                                        <th class="col-sm-3 text-center">Imagem</th>
                                        <th class="col-sm-8">Legenda</th>
                                        <th class="col-sm-1 text-center">#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count(@$itens) > 0)
                                        @foreach($itens as $item)
                                            <tr>
                                                <td class="text-center"
                                                    style="vertical-align: middle; position: relative;">
                                                    <img src="{{asset("/upload/paginas/p_".$item->FotCodigo.".jpg")}}"
                                                         class="img-responsive center-block">
                                                    <div style="text-align: left !important;position: absolute; bottom: 0px; left:0px; padding: 3px;background-color: rgba(255,255,255, 0.9); width: 100%;">
                                                        <a href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos/{{$item->FotCodigo}}/destaque"
                                                           class="btn btn-sm {{($item->FotDestaque == 1) ? "btn-success":"btn-default"}}  btn-destaque "
                                                           data-toggle="tooltip" data-placement="right" title=""
                                                           data-original-title="Imagem destaque"><i
                                                                    class="fa {{($item->FotDestaque == 1) ? "fa-star":"fa-star-o"}}"></i></a>
                                                        <a data-href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos/{{$item->FotCodigo}}/upload"
                                                           class="btn btn-sm btn-primary  btn-upload-multiplo-modal"
                                                           data-toggle="tooltip" data-placement="right" title=""
                                                           data-original-title="Alterar foto"><i
                                                                    class="fa fa-file-image-o"></i></a>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <div class="form-group form{{$item->FotCodigo}}">
                                                        <input type="text" class="form-control legenda" maxlength="300"
                                                               value="{{$item->FotLegenda}}" name="legenda" id="legenda"
                                                               data-id="{{$item->FotCodigo}}"
                                                               data-href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos/{{$item->FotCodigo}}/legenda">
                                                        <span class="help-block span{{$item->FotCodigo}} hidden"></span>
                                                    </div>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a href="{{url('painel')}}/paginas/{{Route::input('id_pag')}}/fotos/{{$item->FotCodigo}}/destroy?{{http_build_query(Input::all())}}"
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
                            <div class="col-sm-12 text-center">
                                {!! $itens->appends(['busca' => Input::get('busca')])->render() !!}
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.row -->
            </section><!-- /.content -->

        </div>
    </div>

@endsection