<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="icon" type="image/png" href="{{asset("imgs/favicon.png")}}"/>
    <meta http-equiv=pragma content=no-cache>
    <meta http-equiv=expires content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta charset="UTF-8">
    <meta name="language" content="pt-br">
    <META name="author" content="Vinicius Tonello">
    <meta name="robots" content="index, follow">
    <META name="title" content="Comissao de Cultura - UTFPR">
    <META name="description"
          content="A comissão de cultura UTFPR existe">
    <META name="keywords"
          content="Comissão de Cultura, UTFPR, cultura, comissão, Cultura UTFPR, comissão UTFPR, UTF">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comissão de Cultura UTFPR</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,900" rel="stylesheet">
    <link href="{{asset("bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset("css/style.css")."?c=".date('YmdHis')}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/lightGallery.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/owl.transitions.css")}}" type="text/css">
</head>
<body>
@include("site.includes.top")
@yield('content')
@include("site.includes.copy")
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="{{asset("plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>

<script src="{{asset("plugins/input-mask/jquery.inputmask.js")}}"></script>
<script src="{{asset("plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
<script src="{{asset("plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
<script src="{{asset("plugins/input-mask/jquery.maskmoney.js")}}"></script>

<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/owl.carousel.js")}}"></script>
<script src="{{asset("js/lightGallery.js")}}"></script>
<script src="{{asset("js/lg-fullscreen.js")}}"></script>
<script src="{{asset("js/lg-pager.js")}}"></script>
<script src="{{asset("js/lg-thumbnail.js")}}"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
    $('.gestao').inputmask('9999/9999');
    $('.cep').inputmask('99999-999');
    $('.telefone').inputmask('(99) 9999-9999[9]');
    $('.date').inputmask('99/99/9999');
    $('.hora').inputmask('99:99');
    $('.mask-cep').inputmask('99999-999');
    $('.mask-ddd').inputmask('(99)');
    $('.mask-phone').inputmask('99999-9999');


    if ($(".light-gallery").size() > 0) {
        $(".light-gallery").lightGallery();
    }
</script>
</body>
</html>
