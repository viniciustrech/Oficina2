@extends("site.templates.app")
@section("title", $titulo)
@section("content")
    <?php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    ?>
    <section class="section-conteudo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="titulo-paginas">EVENTOS</p>
                </div>
                <div class="col-md-12">
                    <p class="titulo-paginas">{{strip_tags(@$conteudo->PagConteudo)}}</p>
                </div>
                <div class="col-sm-4 col-sm-offset-8">
                    <form action="{{url('eventos')}}" method="GET">
                        <div class="input-group">
                            <input type="text" name="busca" id="busca" class="form-control"
                                   placeholder="Buscar por..." value="{{input::get('busca')}}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default" type="button">Buscar</button>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="row">dftyui
                        @foreach($eventos as $evento)
                            <a href="{{url('/evento/'.@$evento->EveCodigo)}}">
                                <div class="col-md-4" style="padding-top: 20px;">
                                    <div class="panel">
                                        <div class="panel-body" style="padding: 0px;">
                                            <div style="background:url('{{asset("upload/eventos/p_".$evento->destaque->FotCodigo.".jpg")}}')"
                                                 class="img-responsive altura-fotos">
                                                <div class="evento">
                                                    <div class="dia">{{date("d",strtotime(@$evento->EveData))}}</div>
                                                    <div class="mes text-uppercase">{{strftime('%b', strtotime(@$evento->EveData))}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer footer-texto  altura-fixa-auto6">
                                            <p class="font16b" align="left" style="padding-top: 20px;">
                                                {{@$evento->EveTitulo}}
                                            </p>
                                            <span class="font14c">
                                                {{strip_tags(substr(@$evento->EveResumo, 0, 150))}}
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