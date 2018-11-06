@extends("site.templates.app")
@section("title",'Contato')
@section("content")
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    ?>
    <section class="section-inscricao">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        {!! $pagina->PagConteudo !!}
                    </p>
                </div>
                <div class="col-md-6">
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

                    <h4 class="text-center">Entre em contato conosco preenchendo o formulário abaixo.</h4> <br>
                    <div class="clearfix visible-xs">&nbsp;</div>

                    <form role="form" action="{{url('/contato')}}" method="post">

                        <div class="col-sm-12">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="pagina" value="contato">

                            <div class="form-group">
                                <input type="text" class="form-control form-contato" id="nome" name="nome"
                                       placeholder="Nome"
                                       required maxlength="150">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-contato" id="email"
                                       name="email"
                                       placeholder="Email"
                                       required maxlength="50">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-contato telefone" id="telefone"
                                       name="telefone"
                                       placeholder="Telefone"
                                       required maxlength="50">
                            </div>
                            <div class="form-group">
                                            <textarea class="form-control form-contato" name="mensagem" id="mensagem"
                                                      placeholder="Mensagem"
                                                      rows="7"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha"
                                     data-sitekey="{{getenv('CAP-KEY')}}"></div>
                            </div>
                        </div>

                        <!-- /.box-body -->

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default"
                                    style="border-radius: 10px; font-size: 20px; padding: 10px 15px; color: #fff; background: #F58634; border: none">
                                <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;&nbsp;Enviar Mensagem
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container hidden-xs">
        <div class="row">
            <div class="col-sm-4">
                <div class="inscricao-foto">
                    <div class="foto"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

