@extends("painel.templates.app")
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Páginas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{getenv("PAINEL")}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{getenv("PAINEL")}}/paginas"> Páginas</a></li>
            <li class="active">Editar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
                <div class="col-md-12">
                    <a href="{{getenv("PAINEL")}}/paginas/create" class="btn btn-primary btn-lg margin-bottom"><i
                                class="fa fa-plus"></i> Adicionar</a>
                </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="with-border"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-4 col-sm-offset-8">
                            <form action="{{getenv("PAINEL")}}/paginas" method="GET">
                                <div class="input-group">
                                    <input type="text" name="busca" id="busca" class="form-control"
                                           placeholder="Buscar por..." value="{{Input::get('busca')}}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" type="button">Buscar</button>
                                    </div>
                                </div><!-- /input-group -->
                                <div class="clearfix">&nbsp;</div>
                            </form>
                        </div>
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
                                    <th class="col-sm-1 text-center">#</th>
                                    {{--<th class="col-sm-1 text-center">Imagem</th>--}}
                                    <th class="col-sm-9">Título</th>
                                    <th class="col-sm-1 text-center">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count(@$itens) > 0)
                                    @foreach($itens as $item)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <span class="fa fa-bars"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="primary">
                                                            <a href="{{getenv("PAINEL")}}/paginas/{{$item->PagCodigo}}/update?{{http_build_query(Input::all())}}">
                                                                <i class="fa fa-edit">&nbsp;</i>Alterar Dados
                                                            </a>
                                                        </li>
                                                        {{--<li>--}}
                                                        {{--<a href="#" class="btn-upload-multiplo-modal"--}}
                                                        {{--data-href="{{getenv("PAINEL")}}/paginas/{{$item->PagCodigo}}/upload">--}}
                                                        {{--<i class="fa fa-camera">&nbsp;</i>Foto Destaque--}}
                                                        {{--</a>--}}
                                                        {{--</li>--}}
                                                        <li>
                                                            <a href="{{getenv("PAINEL")}}/paginas/{{$item->PagCodigo}}/fotos">
                                                                <i class="fa fa-camera">&nbsp;</i>Galeria de Fotos
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            {{--<td class="text-center" style="vertical-align: middle">--}}
                                            {{--<img src="{{asset("/upload/paginas/dest_".$item->PagCodigo.".jpg?cache=".date("YmdHis"))}}"--}}
                                            {{--class="img-responsive">--}}
                                            {{--</td>--}}
                                            <td style="vertical-align: middle">{{$item->PagTitulo}}</td>

                                            @if(Auth::user()->UserNivel == 1)
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a href="{{getenv("PAINEL")}}/paginas/{{$item->PagCodigo}}/destroy?{{http_build_query(Input::all())}}"
                                                       class="btn btn-danger btn-sm btn-destroy"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">
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
        </div>
        <!-- /.row -->
    </section><!-- /.content -->

@endsection