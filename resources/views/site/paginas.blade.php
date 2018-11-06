@extends("site.templates.app")
@section("title",@$titulo)
@section("content")
    <section class="section-home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="titulo-paginas">
                        {{$pagina->PagTitulo}}
                    </p>
                </div>

                @if(($destaque == "1"))
                    <div class="col-sm-12 bloco-conteudo">
                        <div class="row light-gallery">
                            <div class="col-sm-12"
                                 data-src="{{asset("upload/paginas/dest_" . $pagina->PagCodigo . ".jpg")}}"
                                 data-sub-html="{{"<b>".$pagina->PagTitulo."</b><br>".$pagina->PagResumo}}">
                                <img src="{{asset("upload/paginas/dest_" . $pagina->PagCodigo . ".jpg")}}"
                                     class="center-block img-responsive img-thumbnail"
                                     style="padding:5px;">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-12 bloco-conteudo font15c text-justify">
                    {!! $pagina->PagConteudo !!}
                </div>

                @if(count(@$pagina->fotos) > 0)
                    <div class="col-sm-12 bloco-conteudo">
                        <div class="row light-gallery">
                            @foreach($pagina->fotos as $foto)
                                <div class="col-md-2 col-sm-3 col-xs-4 altura-fixa-auto"
                                     data-src="{{asset("upload/paginas/g_" . $foto->FotCodigo . ".jpg")}}"
                                     data-sub-html="{{$foto->FotLegenda}}">
                                    <img src="{{asset("upload/paginas/p_" . $foto->FotCodigo . ".jpg")}}"
                                         class="center-block img-thumbnail img-responsive">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection