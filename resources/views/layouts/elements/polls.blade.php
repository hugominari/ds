{{--<a href="javascript:;" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
<div id="btn-polls" class="btn btn-rounded blue-gradient-rgba tip line-double d-none" data-toggle="modal" data-target="#modalPoll" style="position: fixed; right: 25px; bottom: 15px; z-index: 3" data-placement="top" title="Participe!">
    <i class="far fa-2x fa-file-alt"></i> Enquete
</div>
{{--</a>--}}
<!-- Modal: modalPoll -->
<div class="modal fade right" id="modalPoll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
     data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-primary" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">
                    O que você achou do site?
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            
            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-file-text-o fa-4x mb-3 animated rotateIn"></i>
                    <p>
                        <strong>Sua opnião é muito importante para nós!</strong>
                    </p>
                </div>
                
                <hr>
                
                <!-- Radio -->
                <p class="text-center">
                    <strong>Seu voto</strong>
                </p>
                <div class="form-check mb-4">
                    <input class="form-check-input" name="group1" type="radio" id="radio-179" value="option1" checked>
                    <label class="form-check-label" for="radio-179">Excelente!</label>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" name="group1" type="radio" id="radio-279" value="option2">
                    <label class="form-check-label" for="radio-279">Bom</label>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" name="group1" type="radio" id="radio-379" value="option3">
                    <label class="form-check-label" for="radio-379">Regular</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" name="group1" type="radio" id="radio-479" value="option4">
                    <label class="form-check-label" for="radio-479">Pode Melhorar</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" name="group1" type="radio" id="radio-579" value="option5">
                    <label class="form-check-label" for="radio-579">Ruim</label>
                </div>
                <!-- Radio -->
                
                <p class="text-center">
                    <strong>Se desejar, deixe-nos uma sugestão!</strong>
                </p>
                <!--Basic textarea-->
                <div class="md-form">
                    <textarea type="text" id="form79textarea" class="md-textarea form-control" rows="3"></textarea>
                    <label for="form79textarea">Sugestão / Comentário</label>
                </div>
            
            </div>
            
            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
                <a type="button" class="btn btn-primary waves-effect waves-light">Enviar
                    <i class="fa fa-paper-plane ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Modal: modalPoll -->