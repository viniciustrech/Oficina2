@extends("painel.templates.app")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container">
        <div class="row">
            <section class="content-header">
                <h1>
                    Gerenciar Páginas
                </h1>

            </section>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<a href="{{url('painel')}}/paginas/create" class="btn btn-primary btn-lg margin-bottom"><i class="fa fa-file-powerpoint-o"></i>&nbsp;Cadastrar Página</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="with-border"></div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-4 col-sm-offset-8">
                            <form action="{{url('painel')}}/paginas" method="GET">
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
                                                        <span class="fa fa-file-powerpoint-o"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="primary">
                                                            <a href="{{url('painel')}}/paginas/{{$item->PagCodigo}}/update?{{http_build_query(Input::all())}}">
                                                                <i class="fa fa-info-circle">&nbsp;</i>Conteúdo
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('painel')}}/paginas/{{$item->PagCodigo}}/fotos">
                                                                <i class="fa fa-file-image-o">&nbsp;</i>Fotos
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle">{{$item->PagTitulo}}</td>

                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{url('painel')}}/paginas/{{$item->PagCodigo}}/destroy?{{http_build_query(Input::all())}}"
                                                   class="btn btn-danger btn-sm btn-destroy"><i
                                                            class="fa fa-close"></i></a>
                                            </td>
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