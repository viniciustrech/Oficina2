@extends("painel.templates.app")
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Alterar Páginas
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{getenv("PAINEL")}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{getenv("PAINEL")}}/paginas"> Páginas</a></li>
        <li class="active">Alterar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="with-border"></div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{getenv("PAINEL")}}/paginas/{{$item->PagCodigo}}/update?{{http_build_query(Input::all())}}" method="post">
                    <div class="box-body">
                        <div class="col-sm-12">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">


                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                                       value="{{$item->PagTitulo}}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="resumo">Resumo</label>
                                <textarea class="form-control" id="resumo" name="resumo" placeholder="Resumo" rows="3">{{$item->PagResumo}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="conteudo">Conteúdo</label>
                                <textarea class="form-control ckeditor" id="conteudo" name="conteudo" placeholder="Conteúdo" rows="10">{{$item->PagConteudo}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section><!-- /.content -->

@endsection