<?php $__env->startPush('scripts'); ?>
	<?php echo Html::script('plugins/jquery-mask-plugin/jquery.mask.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="my-5">
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Fale Conosco</h2>
            
            <section class="contact-section my-5 animated fadeInUp">
                <?php echo Form::open(['route' => 'send.contact', 'method' => 'POST', 'class' => 'ajax-form', 'id' => 'form-contact']); ?>

                    <div class="card">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card-body form">
                                    <h3 class="mt-4"><i class="fa fa-envelope pr-2"></i>Digite sua mensagem:</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo e(Form::cText('name', '', 'Nome')); ?>

                                        </div>
                                        <div class="col-md-6">
                                            <?php echo e(Form::cMail('email', '', 'Email')); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo e(Form::cCell('phone', '', 'Telefone')); ?>

                                        </div>
                                        <div class="col-md-6">
                                            <?php echo e(Form::cText('subject', '', 'Assunto')); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo e(Form::cTextareaSend('text', '', 'Mensagem', ['rows' => 3])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-body contact text-center h-100 white-text bg-blue-dark">
                                    <h3 class="my-4 pb-2">Contatos</h3>
                                    <ul class="text-lg-left list-unstyled ml-4">
                                        <li>
                                            <p>
                                                <i class="fa fa-map-marker pr-2"></i>
                                                <span class="">Sindireceita - DF </span><br/>
                                                <span class="ml-4 d-block">Delegacia Sindical de Brasília </span>
                                                <span class="ml-4 d-block">Endereço: SCS Qd. 02 Bloco C </span>
                                                <span class="ml-4 d-block"> Ed: Serra Dourada | Salas 516/517 </span>
                                                <span class="ml-4 d-block"> CEP: 70.300-902</span>
                                            </p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-phone pr-2"></i>(61) 3443-2235 / 3244-8517</p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-fax pr-2"></i>(61) 3443-8065</p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-envelope pr-2"></i>contato@sindireceita-df.org.br</p>
                                        </li>
                                    </ul>
                                    <hr class="hr-light my-4">
                                    <ul class="list-inline text-center list-unstyled">
                                        <?php if(!empty($socials)): ?>
                                            <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-inline-item">
                                                    <a class="p-2 fa-lg tw-ic" href="<?php echo e($social->url); ?>">
                                                        <i class="fab fa-<?php echo e($social->icon); ?> font-24"></i>
                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

            </section>
            
            <section id="section-map" class="wow fadeIn" data-wow-delay=".5s">
                <div id="map-container" class="z-depth-1" style="height: 480px; width:100%;"></div>
                <p class="text-center">
                    <a href="https://goo.gl/maps/NGa2hCPdyNq" class="btn btn-link" target="_blank">Abrir o mapa no google</a>
                </p>
            </section>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>