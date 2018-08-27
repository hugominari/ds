<div class="container">
    <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ asset('img/logo-ico-sm.png') }}" alt="" class="" style="max-height: 50px"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Institucional
                </a>
                <div class="dropdown-menu dropdown-elegant" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('members.directors') }}">Diretoria</a>
                    <a class="dropdown-item" href="{{ route('members.fiscals') }}">Conselho Fiscal</a>
                    <a class="dropdown-item" href="{{ route('internal.rules') }}">Regimento Interno</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts') }}">
                    Publicações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events') }}">
                    Eventos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('covenants') }}">
                    Convênios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cultures') }}">
                    Cultura e Lazer
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts') }}">
                    Fale Conosco
                </a>
            </li>
        </ul>
        <ul class="navbar-nav nav-flex-icons">
        
        </ul>
    </div>
</div>