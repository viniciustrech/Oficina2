@extends("painel.templates.app")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container">
        <div class="row">

            <section class="content-header">
                <h1>
                    Contatos
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="with-border"></div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <form action="{{url('painel')}}/contatos" method="POST">
                                        <div class="input-group">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="text" name="busca" id="busca" class="form-control"
                                                   placeholder="Buscar por..." value="{{Input::get('busca')}}">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default" type="button">Buscar
                                                </button>
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
                                            <th class="col-xs-2">Nome</th>
                                            <th class="col-sm-2 text-center">E-mail</th>
                                            <th class="col-sm-2 text-center">Telefone</th>
                                            <th class="col-sm-3 text-center">Mensagem</th>
                                            <th class="col-sm-1 text-center">Data</th>
                                            <th class="col-sm-1 text-center">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($itens as $item)
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <div class="btn-group">
                                                        <button type="button"
                                                                class="btn btn-sm btn-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <span class="fa fa-address-book"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li class="primary">
                                                                <a href="{{url("painel")}}/contatos/{{$item->ConCodigo}}/view">
                                                                    <i class="fa fa-commenting"></i>&nbsp;Visualizar
                                                                    contato
                                                                </a>
                                                            </li>
                                                            <li class="primary">
                                                                <a href="{{url("painel")}}/contatos/{{$item->ConCodigo}}/responder">
                                                                    <i class="fa fa-share"></i>&nbsp;Responder
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle">{{$item->ConNome}}</td>
                                                <td style="vertical-align: middle">{{$item->ConEmail}}</td>
                                                <td style="vertical-align: middle">{{$item->ConTelefone}}</td>
                                                <td style="vertical-align: middle">{{str_limit($item->ConMensagem, 120)}}</td>
                                                <td style="vertical-align: middle">{{date("d/m/Y",strtotime($item->created_at))}}</td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a href="{{url("painel")}}/contatos/{{$item->ConCodigo}}/destroy"
                                                       class="btn btn-danger btn-sm btn-destroy"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($itens->count() < 1)
                                            <tr>
                                                <td class="text-center" colspan="8">
                                                    Nenhum Registro Encontrado
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>


                                </div>
                                <div class="col-sm-12 text-center">
                                    {!! $itens->render() !!}
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

        </div>
    </div>
@endsection