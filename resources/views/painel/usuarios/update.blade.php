@extends('painel.templates.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuários</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{url('painel/usuarios/'.$item->id).'/update'}}" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="name" value="{{$item->name}}"
                                               placeholder="Nome" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="email" value="{{$item->email}}"
                                               placeholder="E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="senha">Senha</label>
                                        <input type="text" class="form-control" name="senha"
                                               placeholder="Deixe em branco para não alterar!">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save">&nbsp;</i>Salvar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
