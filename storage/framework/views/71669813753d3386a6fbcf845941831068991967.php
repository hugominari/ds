<div class="container">
    <a class="navbar-brand" href="<?php echo e(route('index')); ?>">
        <img src="<?php echo e(asset('img/logo-ico-sm.png')); ?>" alt="Logo" class="img-mobile" style="max-height: 50px"/>
        <img src="<?php echo e(asset('img/logo-horizontal.png')); ?>" alt="Logo" class="img-desktop" style="max-height: 50px"/>
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
                    <a class="dropdown-item" href="<?php echo e(route('members.directors')); ?>">Diretoria</a>
                    <a class="dropdown-item" href="<?php echo e(route('members.fiscals')); ?>">Conselho Fiscal</a>
                    <a class="dropdown-item" href="<?php echo e(route('internal.rules')); ?>">Regimento Interno</a>
                    <a class="dropdown-item" href="<?php echo e(route('history')); ?>">Nossa História</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('posts')); ?>">
                    Publicações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('events')); ?>">
                    Eventos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('agreements')); ?>">
                    Convênios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('cultures')); ?>">
                    Cultura e Lazer
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('contacts')); ?>">
                    Fale Conosco
                </a>
            </li>
        </ul>
        
        <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
                <a class="nav-link color-blue-dark font-weight-bold" href="https://arearestrita.sindireceita.org.br/scripts/FichaDeFiliacao.php" target="_blank">
                    
                        Filie-se
                    
                </a>
            </li>
        </ul>
    </div>
</div>