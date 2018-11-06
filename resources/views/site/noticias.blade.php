@extends("site.templates.app")
@section("title",$titulo)
@section("content")
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    ?>
    <section class="section-conteudo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="titulo-paginas">NOTÍCIAS</p>
                </div>
                <div class="col-md-12">
                    <p class="titulo-paginas">{{strip_tags($conteudo->PagConteudo)}}</p>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach($noticias as $noticia)
                            <a href="{{url('/noticia/'.@$noticia->NotCodigo)}}">
                                <div class="col-md-4" style="padding-top: 20px;">
                                    <div class="panel">
                                        <div class="panel-body" style="padding: 0px;">
                                            <div style="background:url('{{asset("upload/noticias/p_".@$noticia->destaque->FotCodigo.".jpg")}}')"
                                                 class="img-responsive altura-fotos">
                                                <div class="noticia">
                                                    <div class="dia">{{date("d",strtotime(@$noticia->NotData))}}</div>
                                                    <div class="mes text-uppercase">{{strftime('%b', strtotime(@$noticia->NotData))}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer footer-texto  altura-fixa-auto6">
                                            <p class="font16b" align="left" style="padding-top: 20px;">
                                                {{@$noticia->NotTitulo}}
                                            </p>
                                            <span class="font14c">
                                                {{strip_tags(substr(@$noticia->NotResumo, 0, 150))}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection