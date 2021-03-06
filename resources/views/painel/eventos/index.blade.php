@extends("painel.templates.app")
@section('content')
    <div class="container">
        <div class="row">
            <section class="content-header">
                <h1>
                    Gerenciar Eventos
                </h1>

            </section>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{url('painel')}}/eventos/create" class="btn btn-primary btn-lg margin-bottom">
                        <i class="fa fa-microphone"></i>&nbsp;Cadastrar Evento
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="with-border"></div>
                    <div class="box-body">
                        <div class="col-sm-4 col-sm-offset-8">
                            <form action="{{url('painel')}}/eventos" method="GET">
                                <div class="input-group">
                                    <input type="text" name="busca" id="busca" class="form-control"
                                           placeholder="Buscar por..." value="{{input::get('busca')}}">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" type="button">Buscar</button>
                                    </div>
                                </div>
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
                                    <th class="col-sm-1 text-center">Imagem</th>
                                    <th class="col-sm-1 text-center">Data</th>
                                    <th class="col-sm-7">Título</th>
                                    <th class="col-sm-1 text-center">Liberado</th>
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
                                                        <span class="fa fa-microphone"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="primary">
                                                            <a href="{{url('painel')}}/eventos/{{$item->EveCodigo}}/update">
                                                                <i class="fa fa-info-circle">&nbsp;</i>Conteúdo
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('painel')}}/eventos/{{$item->EveCodigo}}/fotos">
                                                                <i class="fa fa-file-image-o">&nbsp;</i>Fotos
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{url('painel')}}/eventos/{{$item->EveCodigo}}/documentos">
                                                                <i class="fa fa-file-pdf-o">&nbsp;</i>Documentos
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <img src="{{asset("/upload/eventos/p_".@$item->destaque->FotCodigo.".jpg?cache=".date("YmdHis"))}}"
                                                     class="img-responsive">
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{date("d/m/Y",strtotime($item->EveData))}}
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{$item->EveTitulo}}
                                            </td>
                                            <td class="text-center"
                                                style="vertical-align: middle">
                                                <i class="fa {{($item->EveLiberado == 1) ? "fa-check" : "fa-close" }}"></i>

                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{url('painel')}}/eventos/{{$item->EveCodigo}}/destroy"
                                                   class="btn btn-danger btn-sm btn-destroy">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">
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
        </div>
    </section>
@endsection