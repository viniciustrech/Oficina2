@extends("painel.templates.app")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container">
        <div class="row">

            <section class="content-header">
                <h1>
                    Contato
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
                            <!-- form start -->
                            <div class="box-body">
                                <div class="col-sm-12">
                                    {!! $item->ConConteudo !!}
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="col-sm-12">
                                    <a class="btn btn-primary" href="{{url('painel')}}/contatos"><< Voltar</a>
                                    <a class="btn btn-primary" href="{{url("painel")}}/contatos/{{$item->ConCodigo}}/responder">Responder</a>
                                </div>
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