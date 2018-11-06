@extends("site.templates.app")
@section("title",'Documentos')
@section("content")
    <section class="section-conteudo">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <div class="panel fundo-padrao fundo-padrao-sec">
                        <div class="panel-body">
                            <div class="row">
                                @if(count(@$downloads) > 0)
                                    <div class="col-md-12 table-responsive">
                                        <table width="100%">
                                            @foreach($downloads as $download)
                                                <tr>
                                                    <td>
                                                        <a href="{{asset("documentos".$download->DowArquivo)}}"
                                                           class="btn cor2-bg branco btn-sm center-block" target="_blank" target="_blank">
                                                            <i class="fa fa-file-pdf-o fa-2x"></i>
                                                        </a>
                                                    </td>
                                                    <td class="col-sm-12"
                                                        style="vertical-align: middle;">
                                                        <a href="{{asset("documentos".$download->DowArquivo)}}" target="_blank">
                                                            {{$download->DowTitulo}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
