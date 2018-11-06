@extends("site.templates.app")
@section("title", 'Sobre')
@section("content")
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    ?>
    <section class="section-conteudo">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <p>
                        {!! $pagina->PagConteudo !!}
                    </p>
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

