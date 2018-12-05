<?php $__env->startSection('content'); ?>
    
    
    <?php echo Form::open(['route' => 'login', 'method' => 'POST', 'class' => 'ajax-form']); ?>

    <!-- Main navigation -->
    <header class="">
        <!-- Full Page Intro -->
        <div class="" style="background-image: url(<?php echo e(asset('img/background.jpg')); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask d-flex justify-content-center align-items-center pb-5 pt-2">
                <!-- Content -->
                <div class="container pb-5">
                    <!--Grid row-->
                    <div class="row pt-lg-5 mt-lg-5">
                       
                        <!--Grid column-->
                        <div class="col-md-6 offset-md-3 mb-4">
                            <!--Form-->
                            <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                <div class="card-body z-depth-2">
                                    <!--Header-->
                                    <div class="text-center">
                                        <h3 class="dark-grey-text">
                                            <strong>Painel Administrativo</strong>
                                        </h3>
                                        <hr>
                                    </div>
                                    <!--Body-->
                                    <?php echo e(Form::cText('username', '', 'Nome de Usuário')); ?>

                                    <?php echo e(Form::cPassword('password', '', 'Senha')); ?>

                                    <?php echo e(Form::cCheckbox('remember', '1', 'Lembrar-me')); ?>

                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="btn-login" type="submit" class="btn btn-primary float-right">
                                                <?php echo e(__('Entrar')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.Form-->
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </div>
                <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
    </header>
    <!-- Main navigation -->
    <?php echo Form::close(); ?>

    
    
    

    
        
            
                

                
                    
                        

                        
                            

                            
                                

                                
                                    
                                        
                                    
                                
                            
                        

                        
                            

                            
                                

                                
                                    
                                        
                                    
                                
                            
                        

                        
                            
                                
                                    

                                    
                                        
                                    
                                
                            
                        

                        
                            
                                
                                    
                                

                                
                                    
                                
                            
                        
                    
                
            
        
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>