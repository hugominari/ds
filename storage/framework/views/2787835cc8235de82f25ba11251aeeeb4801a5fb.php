<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2 class="h1-responsive font-weight-bold mb-2">
            Regimento interno
        </h2>
        <div class="card mb-3 hoverable m-t-50 animated fadeIn">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="view overlay">
                            <object data="<?php echo e($file->url); ?>" type="application/pdf" width="100%" height="74%" style="height: 74vh">
                                <blockquote class="blockquote bq-danger">
                                    <p class="font-weight-bold">
                                        Parece que seu navagador não suporta a leitura direta do arquivo PDF!
                                    </p>
                                    <p class="text-justify">
                                        Para visualizá-lo você deverá fazer o download para seu dispositivo. <br/>
                                        Atualize seu <b>navegador</b>, um novo browser protege-o melhor contra esquemas, <b>vírus</b>, <b>trojans</b>, <b>phishing</b> e outras ameaças!
                                    </p>
                                </blockquote>
                            </object>
                        </div>
                        <a href="<?php echo e($file->url); ?>" target="_blank">
                            <button class="btn btn-outline-grey ml-0">
                                <i class="fas fa-cloud-download-alt pr-2"></i>
                                Fazer Download do arquivo
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>