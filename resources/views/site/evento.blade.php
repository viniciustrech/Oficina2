@extends("site.templates.app")
@section("title",$evento->EveTitulo)
@section("metatags")
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="{{$evento->EveResumo}}"/>
    <meta property="og:title" content="{{strip_tags($evento->EveTitulo)}}"/>
    <meta property="og:url" content="{{url("/evento/".$evento->EveCodigo."?".date("YmdHis"))}}"/>
    <meta property="og:site_name" content="{{getenv("EMPRESA")}}"/>
    <meta property="article:publisher" content=""/>
    <meta property="og:image" itemprop="image"
          content="{{asset("upload/eventos/dest_" . $evento->EveCodigo . ".jpg")}}"/>
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
                            <img src="{{asset("upload/eventos/p_" . @$evento->destaque->FotCodigo . ".jpg")}}"
                                 title="{{@$evento->EveLegendaFoto}}"
                                 class="center-block img-responsive img-thumbnail" style="padding:5px;"
                                 data-toggle="tooltip">
                            <div class="font10a text-center">{{@$evento->EveLegendaFoto}}</div>
                        </div>
                        @if(count(@$itens) > 0)
                            <div class="col-sm-8" style="margin-top: 10px">
                                <div class="row light-gallery">
                                    @foreach($itens as $item)
                                        <div class="col-xs-6 col-sm-4 mini-fotos"
                                             data-src="{{asset("upload/eventos/g_" . @$item->FotCodigo . ".jpg")}}"
                                             data-sub-html="{{"<b>".@$item->FotLegenda."</b>"}}">
                                            {{--EXIBE FOTOS--}}
                                            <img src="{{asset("upload/eventos/p_" . @$item->FotCodigo . ".jpg")}}"
                                                 class="center-block img-responsive img-thumbnail"
                                                 style="padding:5px; margin-bottom: 5px; max-height: 140px !important;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <p class="titulo-paginas">{{@$evento->EveTitulo}}</p>
                        </div>
                        <div class="col-sm-12 text-justify" style="margin-top: 5px;">
                            {!! @$evento->EveConteudo !!}
                        </div>

                        <div class="clearfix" style="padding-top: 15px">&nbsp;</div>

                        <div class="row">
                            @if(count(@$documentos) > 0)
                                <div class="col-md-12 table-responsive">
                                    <table width="100%">
                                        @foreach($documentos as $documento)
                                            <tr>
                                                <td>
                                                    <a href="{{asset("upload/documentos/".$documento->DocArquivo)}}"
                                                       class="btn cor2-bg branco btn-sm center-block" target="_blank">
                                                        <i class="fa fa-file-pdf-o fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td class="col-sm-12"
                                                    style="vertical-align: middle;">
                                                    <a href="{{asset("upload/documentos/".$documento->DocArquivo)}}" target="_blank">
                                                        {{$documento->DocTitulo}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>


                        <div class="row" style="">
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-primary btn-xs"
                                   href="http://www.facebook.com/sharer.php?u={{url("/evento/".$evento->EveCodigo."?".date("YmdHis"))}}"
                                   title="Compartilhar via Facebook" target="_blank"><span><i
                                                class="fa fa-facebook-square"></i> Facebook</span></a>

                                <a class="btn btn-info btn-xs"
                                   href="http://twitter.com/share?url={{url("/evento/".$evento->EveCodigo."?".date("YmdHis"))}}&amp;text={{getenv("EMPRESA")}} - {{$evento->EveTitulo}}"
                                   title="Compartilhar no Twitter" target="_blank"><span><i
                                                class="fa fa-twitter"></i> Twitter</span></a>

                                <a class="btn btn-success btn-xs hidden-lg hidden-md hidden-sm"
                                   href="whatsapp://send?text={{url("/evento/".$evento->EveCodigo."?".date("YmdHis"))}}"
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



