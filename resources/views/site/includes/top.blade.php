<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/home')}}">Comissão de Cultura UTFPR</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="{{url('/eventos')}}" role="button"
                       aria-expanded="false">Eventos</a>
                </li>
                <li class="dropdown">
                    <a href="{{url('/noticias')}}" role="button"
                       aria-expanded="false">Notícias</a>
                </li>
                <li class="dropdown">
                    <a href="{{url('/sobre')}}" role="button"
                       aria-expanded="false">Sobre</a>
                </li>
                <li><a href="{{url('/contato')}}">Contato</a></li>
            </ul>
        </div>
    </div>
</nav>