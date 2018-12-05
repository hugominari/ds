<!-- SideNav slide-out button -->
<div class="float-left">
	<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
</div>
<!-- Breadcrumb-->
<div class="p-t-15 pl-4 mr-auto text-white">
	<p><i class="fas fa-database pr-2"></i>Painel de Controle</p>
</div>
<ul class="nav navbar-nav nav-flex-icons ml-auto">
	<li class="nav-item pr-1">
		<a id="create-attendance" class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#makeAttendance"><i class="fas fa-headset mr-2"></i><span class="clearfix d-none d-sm-inline-block">Criar Atendimento</span></a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle waves-effect waves-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-id-card-alt pr-1"></i> {{ $userLogged->name }}
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			{{--<a id="my-account" class="dropdown-item waves-effect waves-light" href="javascript:;"><i class="fas fa-user-edit pr-1"></i> Meu Perfil</a>--}}
			<a id="btn-logout" class="dropdown-item waves-effect waves-light" href="javascript:;"><i class="fas fa-power-off pr-2"></i> Fazer Logout</a>
		</div>
	</li>
</ul>