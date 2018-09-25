@extends("painel.templates.app")
@section('content')
<section class="content-header">
    <h1>
        Alterar Notícias
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{getenv("PAINEL")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{getenv("PAINEL")}}/noticias"> Notícias</a></li>
        <li class="active">Alterar</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="with-border"></div>
                <form role="form" action="{{getenv("PAINEL")}}/noticias/{{$item->NotCodigo}}/update?{{http_build_query(Input::all())}}" method="post">
                    <div class="box-body">
                        <div class="col-sm-12">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="text" class="form-control datepicker" id="data" name="data" size="10" maxlength="10"
                                       placeholder="Data" value="{{date("d/m/Y",strtotime($item->NotData))}}" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                                       value="{{$item->NotTitulo}}"
                                       required maxlength="150">
                            </div>
                            <div class="form-group">
                                <label for="resumo">Resumo</label>
                                <input type="text" class="form-control" id="resumo" name="resumo" placeholder="Resumo"
                                       value="{{$item->NotResumo}}" maxlength="200">
                            </div>
                            <div class="form-group">
                                <label for="conteudo">Conteúdo</label>
                            <textarea class="form-control ckeditor" name="conteudo" id="conteudo" placeholder="Conteúdo"
                                      rows="10">{{$item->NotConteudo}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="legenda">Legenda Foto</label>
                                <input type="text" class="form-control" id="legenda" name="legenda"
                                       placeholder="Legenda"
                                       value="{{$item->NotLegendaFoto}}" maxlength="200">
                            </div>
                            <div class="form-group">
                                <label for="fonte">Fonte</label>
                                <input type="text" class="form-control" id="fonte" name="fonte" placeholder="Fonte"
                                       value="{{$item->NotFonte}}" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="legenda">Liberado</label>
                                <br>

                                <div class="radio-inline">
                                    <label><input type="radio" name="liberado" id="liberado"
                                                  value="1" {{($item->NotLiberado == 1)?"checked":""}}>Sim</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="liberado" id="liberado"
                                                  value="0" {{($item->NotLiberado == 0)?"checked":""}}>Não</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection