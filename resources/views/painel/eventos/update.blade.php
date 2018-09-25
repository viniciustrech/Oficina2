@extends("painel.templates.app")
@section('content')
<section class="content-header">
    <h1>
        Alterar Eventos
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('painel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('painel')}}/eventos"> Eventos</a></li>
        <li class="active">Alterar</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="with-border"></div>
                <form role="form" action="{{url('painel')}}/eventos/{{$item->EveCodigo}}/update" method="post">
                    <div class="box-body">
                        <div class="col-sm-12">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                                       value="{{$item->EveTitulo}}"
                                       required maxlength="150">
                            </div>
                            <div class="form-group">
                                <label for="resumo">Resumo</label>
                                <input type="text" class="form-control" id="resumo" name="resumo" placeholder="Resumo"
                                       value="{{$item->EveResumo}}" maxlength="200">
                            </div>
                            <div class="form-group">
                                <label for="conteudo">Conteúdo</label>
                            <textarea class="form-control ckeditor" name="conteudo" id="conteudo" placeholder="Conteúdo"
                                      rows="10">{{$item->EveConteudo}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="text" class="form-control datepicker" id="data" name="data" size="10" maxlength="10"
                                       placeholder="Data" value="{{date("d/m/Y",strtotime($item->EveData))}}" required>
                            </div>
                            <div class="form-group">
                                <label for="legenda">Liberado</label>
                                <br>

                                <div class="radio-inline">
                                    <label><input type="radio" name="liberado" id="liberado"
                                                  value="1" {{($item->EveLiberado == 1)?"checked":""}}>Sim</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="liberado" id="liberado"
                                                  value="0" {{($item->EveLiberado == 0)?"checked":""}}>Não</label>
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