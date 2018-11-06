<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Painel de Controle</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="{{url('/painel/eventos')}}" role="button"
                           aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> Eventos</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{url('/painel/noticias')}}" role="button"
                           aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> Notícias</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{url('/painel/paginas')}}" role="button"
                           aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> Páginas</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{url('/painel/contatos')}}" role="button"
                           aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> Contatos</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{url('/painel/usuarios')}}" role="button"
                           aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> Usuários</a>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>