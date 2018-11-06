@extends("site.templates.app")
@section("title",$noticia->NotTitulo)
@section("metatags")
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="{{$noticia->NotResumo}}"/>
    <meta property="og:title" content="{{strip_tags($noticia->NotTitulo)}}"/>
    <meta property="og:url" content="{{url("/noticia/".$noticia->NotCodigo."?".date("YmdHis"))}}"/>
    <meta property="og:site_name" content="{{getenv("EMPRESA")}}"/>
    <meta property="article:publisher" content=""/>
    <meta property="og:image" itemprop="image"
          content="{{asset("upload/noticias/dest_" . $noticia->NotCodigo . ".jpg")}}"/>
@endsection
@section("content")
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    ?>
    <section class="section-conteudo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-4">
                                <img src="{{asset("upload/noticias/p_" . @$noticia->destaque->FotCodigo . ".jpg")}}"
                                     title="{{@$noticia->NotLegendaFoto}}"
                                     class="center-block img-responsive img-thumbnail" style="padding:5px;"
                                     data-toggle="tooltip">
                                <div class="font10a text-center">{{@$noticia->NotLegendaFoto}}</div>
                            </div>
                        @if(count(@$itens) > 0)
                            <div class="col-sm-8" style="margin-top: 10px">
                                <div class="row light-gallery">
                                    @foreach($itens as $item)
                                        <div class="col-xs-6 col-sm-4 mini-fotos"
                                             data-src="{{asset("upload/noticias/g_" . @$item->FotCodigo . ".jpg")}}"
                                             data-sub-html="{{"<b>".@$item->FotLegenda."</b>"}}">
                                            {{--EXIBE FOTOS--}}
                                            <img src="{{asset("upload/noticias/p_" . @$item->FotCodigo . ".jpg")}}"
                                                 class="center-block img-responsive img-thumbnail"
                                                 style="padding:5px; margin-bottom: 5px; max-height: 140px !important;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <p class="titulo-paginas">{{@$noticia->NotTitulo}}</p>
                        </div>
                        <div class="col-sm-12 text-justify" style="margin-top: 5px;">
                            {!! @$noticia->NotConteudo !!}
                        </div>

                        @if(@$noticia->NotFonte != "")
                            <div class="col-sm-12 font12a" style="margin-top: 20px">
                                {{ utf8_encode(strftime('%d de %B de %Y', strtotime(@$noticia->NotData)))}}
                            </div>
                            <div class="col-sm-12" style="margin-top: 30px;">
                                <h6>Fonte: {!! $noticia->NotFonte !!}</h6>
                            </div>

                        @endif
                        <div class="clearfix" style="padding-top: 15px">&nbsp;</div>
                        <div class="row" style="">
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-primary btn-xs"
                                   href="http://www.facebook.com/sharer.php?u={{url("/noticia/".$noticia->NotCodigo."?".date("YmdHis"))}}"
                                   title="Compartilhar via Facebook" target="_blank"><span><i
                                                class="fa fa-facebook-square"></i> Facebook</span></a>

                                <a class="btn btn-info btn-xs"
                                   href="http://twitter.com/share?url={{url("/noticia/".$noticia->NotCodigo."?".date("YmdHis"))}}&amp;text={{getenv("EMPRESA")}} - {{$noticia->NotTitulo}}"
                                   title="Compartilhar no Twitter" target="_blank"><span><i
                                                class="fa fa-twitter"></i> Twitter</span></a>

                                <a class="btn btn-success btn-xs hidden-lg hidden-md hidden-sm"
                                   href="whatsapp://send?text={{url("/noticia/".$noticia->NotCodigo."?".date("YmdHis"))}}"
                                   title="Compartilhar no WhatsApp" target="_blank"><span><i
                                                class="fa fa-whatsapp"></i><span> WhatsApp</span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



