@extends("painel.templates.app")
@section('content')
    <div class="container">
        <div class="row">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Adicionar Páginas
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header"></div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="{{url('painel')}}/paginas/create" method="post">
                                <div class="box-body">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="form-group">
                                            <label for="titulo">Título</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo"
                                                   placeholder="Título"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="resumo">Resumo</label>
                                            <textarea class="form-control" id="resumo" name="resumo"
                                                      placeholder="Resumo" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="conteudo">Conteúdo</label>
                                            <textarea class="form-control ckeditor" id="conteudo" name="conteudo"
                                                      placeholder="Conteúdo" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- /.row -->
            </section><!-- /.content -->

        </div>
    </div>
@endsection