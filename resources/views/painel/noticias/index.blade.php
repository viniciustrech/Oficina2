@extends("painel.templates.app")
@section('content')
    <section class="content-header">
        <h1>
            Editar Notícias
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{getenv("PAINEL")}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{getenv("PAINEL")}}/noticias"> Notícias</a></li>
            <li class="active">Editar</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{getenv("PAINEL")}}/noticias/create" class="btn btn-primary btn-lg margin-bottom">
                    <i class="fa fa-plus"></i> Adicionar
                </a>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="with-border"></div>
                    <div class="box-body">
                        <div class="col-sm-4 col-sm-offset-8">
                            <form action="{{getenv("PAINEL")}}/noticias" method="GET">
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
                                                        <span class="fa fa-bars"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="primary">
                                                            <a href="{{getenv("PAINEL")}}/noticias/{{$item->NotCodigo}}/update?{{http_build_query(Input::all())}}">
                                                                <i class="fa fa-edit">&nbsp;</i>Alterar Dados
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{getenv("PAINEL")}}/noticias/{{$item->NotCodigo}}/fotos">
                                                                <i class="fa fa-camera">&nbsp;</i>Galeria de Fotos
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="javascript:void(0);" title="<center>Imagem Atual</center>"
                                                   data-toggle="popover"
                                                   data-placement="bottom"
                                                   data-html="true" data-trigger="focus"
                                                   data-content='<img src="{{asset("/upload/noticias/p_".@$item->destaque->FotCodigo.".jpg?cache=".date("YmdHis"), strtotime(@$item->destaque->updated_at))}}" class=img-responsive>'>
                                                    <img src="{{asset("/upload/noticias/p_".@$item->destaque->FotCodigo.".jpg?cache=".date("YmdHis"), strtotime(@$item->destaque->updated_at))}}"
                                                         class="img-responsive">
                                                </a>
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{date("d/m/Y",strtotime($item->NotData))}}
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{$item->NotTitulo}}
                                            </td>
                                            <td class="text-center"
                                                style="vertical-align: middle">
                                                <button type="button"
                                                        class="btn {{($item->NotLiberado == 1) ? "btn-info" : "btn-warning" }} liberar"
                                                        data-href="{{getenv("PAINEL")}}/noticias/{{$item->NotCodigo}}/liberado">
                                                    {{($item->NotLiberado == 1) ? "SIM" : "NÃO" }}
                                                </button>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <a href="{{getenv("PAINEL")}}/noticias/{{$item->NotCodigo}}/destroy?{{http_build_query(Input::all())}}"
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
                        <div class="col-sm-12 text-center">
                            {!! $itens->appends(['busca' => Input::get('busca')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection