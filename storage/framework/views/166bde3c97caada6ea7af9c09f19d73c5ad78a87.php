<ul class="custom-scrollbar list-unstyled ps ps--theme_default ps--active-y">
	<li>
		<div class="waves-light waves-effect waves-light sn-bg-3 py-3">
			<img src="<?php echo e(asset('img/logo-sm.png')); ?>" class="img-fluid d-flex mx-auto">
		</div>
	</li>
	<li>
		<ul class="collapsible collapsible-accordion">
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-building"></i>
					Intitucional<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('admin.internal-rules')); ?>" class="waves-effect">Regimento Interno</a>
						</li>
						<li><a href="<?php echo e(route('admin.history')); ?>" class="waves-effect">Nossa História</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-puzzle-piece"></i>
					Cadastro Básico<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(url('admin/basic/websites')); ?>" class="waves-effect">Site Úteis</a>
						</li>
						<li><a href="<?php echo e(url('admin/basic/feeds')); ?>" class="waves-effect">Feeds</a>
						</li>
						<li><a href="<?php echo e(url('admin/basic/positions')); ?>" class="waves-effect">Cargos</a>
						</li>
						<li><a href="<?php echo e(url('admin/basic/type_calls')); ?>" class="waves-effect">Tipos Atendimento</a>
						</li>
					</ul>
				</div>
			</li>
			
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-users"></i>
					Membros<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('members.index')); ?>" class="waves-effect">Ver todos</a>
						</li>
						<li><a href="<?php echo e(route('members.create')); ?>" class="waves-effect">Criar novo</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chair"></i>
					Mandatos<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('mandatory.index')); ?>" class="waves-effect">Ver
								todos</a>
						</li>
						<li><a href="<?php echo e(route('mandatory.create')); ?>" class="waves-effect">Criar
								novo</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-bullhorn"></i>
					Publicações<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('posts.index')); ?>" class="waves-effect">Ver todas</a>
						</li>
						<li><a href="<?php echo e(route('posts.create')); ?>" class="waves-effect">Criar nova</a>
						</li>
					</ul>
				</div>
			</li>
			
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-share-alt-square"></i>
					Redes Sociais<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('socials.index')); ?>" class="waves-effect">Ver todas</a>
						</li>
						<li><a href="<?php echo e(route('socials.create')); ?>" class="waves-effect">Criar nova</a>
						</li>
					</ul>
				</div>
			</li>
			
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-hands-helping"></i>
					Convênios<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('covenants.index')); ?>" class="waves-effect">Ver todos</a>
						</li>
						<li><a href="<?php echo e(route('covenants.create')); ?>" class="waves-effect">Criar novo</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-cocktail"></i>
					Eventos<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('events.index')); ?>" class="waves-effect">Ver todos</a>
						</li>
						<li><a href="<?php echo e(route('events.create')); ?>" class="waves-effect">Criar novo</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-theater-masks"></i>
					Cultura e Lazer<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('cultures.index')); ?>" class="waves-effect">Ver todos</a>
						</li>
						<li><a href="<?php echo e(route('cultures.create')); ?>" class="waves-effect">Criar novo</a>
						</li>
					</ul>
				</div>
			</li>
			<li class=""><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-user"></i>
					Usuários<i class="fa fa-angle-down rotate-icon"></i></a>
				<div class="collapsible-body" style="display: none;">
					<ul>
						<li><a href="<?php echo e(route('users.index')); ?>" class="waves-effect">Ver todos</a>
						</li>
						<li><a href="<?php echo e(route('users.create')); ?>" class="waves-effect">Criar novo</a>
						</li>
					</ul>
				</div>
			</li>
			
			<li class=""><a href="<?php echo e(route('attendance.index')); ?>" class="waves-effect"><i class="fas fa-headset"></i>
					Atendimentos</a>

			<li class=""><a href="<?php echo e(route('contacts.index')); ?>" class="waves-effect"><i class="far fa-comment"></i>
					Fale Conosco</a>
		</ul>
	</li>
</ul>