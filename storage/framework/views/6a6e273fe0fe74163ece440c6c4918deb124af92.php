<?php $__env->startPush('styles'); ?>
    <?php echo e(Html::style('plugins/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js'); ?>

    <?php echo Html::script('js/pages/basic.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="row m-b-10">
            <div class="col-md-8">
                <h1><i class="fas fa-sitemap"></i> Cargos</h1>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="display-inline-block pull-right m-t-11">
                    <button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
                </a>
            </div>
        </div>
    </section>
   
    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <?php echo Form::open(['route' => 'basic.create', 'method' => 'POST', 'class' => 'ajax-form']); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Cadastro de Cargos
                            </div>
                            <div class="card-body">
                                <?php echo e(Form::cText('name', '', 'Nome do Cargo')); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo e(Form::cSelect('type', '', 'Tipo', $types)); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-none">
                                <?php echo e(Form::cText('id', '', '', ['class' => 'hide'])); ?>

                                <?php echo e(Form::cText('model', 'positions', '', ['class' => 'hide'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php $__env->startComponent('components.fixed-actions'); ?><?php echo $__env->renderComponent(); ?>
                <?php echo Form::close(); ?>

            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="box-title text-capitalize">Listagem</h3>
                    </div>
                    <div class="card-body">
                        <table class="dataTable no-footer w-r-100" data-source="<?php echo route('basic.list', 'positions'); ?>" data-type="datatables">
                            <thead>
                                <tr>
                                    <th data-slug="name" class="sort default-sort">Nome</th>
                                    
                                    <th data-slug="type" class="sort">Tipo</th>
                                    <th data-slug="action" class="no-sort">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>