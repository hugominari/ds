<?php $__env->startSection('content'); ?>
	
	<div class="container">
		
		
		<section class="mt-5 wow fadeIn magazine-section my-5">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<?php if(!empty($pinPost)): ?>
						<div class="single-news mb-lg-0 mb-4 clickable cursor-pointer" data-href="<?php echo e(route('show.post', ['id' => $pinPost->id])); ?>">
							<div class="view overlay rounded z-depth-1-half mb-4 heigth-250">
								<img class="img-fluid obj-fit" src="<?php echo e($pinPost->image->url_lg); ?>"
									 alt="<?php echo e($pinPost->title); ?>">
								
								<div class="mask rgba-white-slight waves-effect waves-light"></div>
							</div>
							<div class="news-data d-flex justify-content-between">
								<h6 class="font-weight-bold"><?php echo $pinPost->tag; ?></h6>
								<p class="font-weight-bold dark-grey-text"><i
											class="fa fa-clock-o pr-2"></i><?php echo e($pinPost->created_at->format('d/m/Y')); ?>

								</p>
							</div>
							<h3 class="font-weight-bold dark-grey-text mb-3"><a><?php echo e($pinPost->title); ?></a></h3>
							<p class="dark-grey-text mb-lg-0 mb-md-5 mb-4"><?php echo $pinPost->resume; ?></p>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-lg-6 col-md-12">
					<?php if(!empty($lastPosts)): ?>
						<?php $__currentLoopData = $lastPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="single-news mb-4 clickable cursor-pointer" data-href="<?php echo e(route('show.post', ['id' => $lastPost->id])); ?>">
								<div class="row">
									<div class="col-md-3">
										<div class="view overlay rounded z-depth-1 mb-4 heigth-110">
											<img class="img-fluid obj-fit" src="<?php echo e($lastPost->image->url_sm); ?>"
												 alt="<?php echo e($lastPost->title); ?>">
												<div class="mask rgba-white-slight waves-effect waves-light"></div>
										</div>
									</div>
									<div class="col-md-9">
										<p class="font-weight-bold dark-grey-text"><?php echo e($lastPost->created_at->format('d/m/Y')); ?></p>
										<div class="d-flex justify-content-between">
											<div class="col-11 text-truncate pl-0 mb-3">
												<p><?php echo e($lastPost->title); ?></p>
												<?php echo $lastPost->resume; ?>

											</div>
											
											<i class="fa fa-angle-double-right"></i>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
		
		<hr class="my-5 wow slideInRight">
		
		
		<section id="widget-all-posts" class="my-5">
			<div class="row">
				<div class="col-md-6 wow fadeInLeft">
					<div class="row mb-3">
						<div class="col-12">
                            <span class="badge bg-yellow-dark">
                                <i class="fas fa-rss mr-1"></i>Outras publicações
                            </span>
						</div>
					</div>
					<?php if(!empty($lastPosts)): ?>
						<?php $__currentLoopData = $lastPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="single-news mb-3 clickable cursor-pointer" data-href="<?php echo e(route('show.post', ['id' => $lastPost->id])); ?>">
								<div class="d-flex justify-content-between">
									<div class="col-11 text-truncate pl-0 mb-3">
										<small class="font-12"><?php echo e($lastPost->created_at->format('d/m/Y')); ?></small> - <?php echo e($lastPost->title); ?>

									</div>
									<i class="fa fa-angle-double-right"></i>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<div class="col"></div>
				<div class="col-md-5 wow fadeInRight">
					<div class="feed">
						<?php if(!empty($feeds)): ?>
							<?php $__currentLoopData = $feeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="single-news mb-3">
									<div class="row mb-3">
										<div class="col-12">
											<span class="badge bg-blue">
												<i class="fas fa-rss mr-1"></i>
												<?php echo e($feed->name); ?>

											</span>
										</div>
									</div>
								</div>
								<?php echo $feed->getFeed(); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		
		<hr class="my-5 wow slideInRight">
		
		
		<section id="widget-campaigns" class="my-5 wow fadeIn">
			<div class="row">
				<div class="col-md-12">
					<h2 class="h1-responsive font-weight-bold float-left pt-3">Campanhas</h2>
					<div class="controls-top float-right">
						<a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-left"><i
									class="fa fa-chevron-left"></i></a>
						<a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-right"><i
									class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			<div class="row py-4">
				<div class="col-md-12">
					<div class="swiper-container campaigns">
						<div class="swiper-wrapper my-3">
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_convencao.gif"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_projeto_receita.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_educacao_fiscal.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_ecac.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_pirataria.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_movimento_brasil.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</section>
		
		
		<section id="widget-sites" class="my-5 wow fadeIn">
			<ul class="nav nav-tabs md-tabs nav-justified bg-gray w-r-100 mx-auto" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#sites-util" role="tab"><i
								class="fas fa-link pr-1"></i> Sites Úteis</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#sites-educativos" role="tab"><i
								class="fas fa-book-open pr-1"></i> Sites Educativos</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in show active text-left" id="sites-util" role="tabpanel">
					<br>
					<div class="row">
						<?php if(!empty($sitesUteis)): ?>
							<?php $__currentLoopData = $sitesUteis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteUtil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-sm-12 col-md-6">
									<a href="<?php echo e($siteUtil->url); ?>" class="btn btn-link waves-effect waves-ripple"
									   target="_blank">
										<?php echo e($siteUtil->name); ?>

									</a>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="tab-pane fade" id="sites-educativos" role="tabpanel">
					<br>
					<div class="row">
						<?php if(!empty($sitesEducatives)): ?>
							<?php $__currentLoopData = $sitesEducatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteEducativo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-sm-12 col-md-6">
									<a href="<?php echo e($siteEducativo->url); ?>" class="btn btn-link waves-effect waves-ripple"
									   target="_blank">
										<?php echo e($siteEducativo->name); ?>

									</a>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
	
	</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>