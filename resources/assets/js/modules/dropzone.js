/**
 * This event will apply the dropzone effect to any element that has the data-type dropzone attribute
 * @event Jquery#each
 */
/**
 * DropZone
 */
try {
    Dropzone.autoDiscover = false;

    function loadDropzone(element) {
        if (!element)
            element = $("[data-type='dropzone']");

        element.each(function (e) {
            var dz = $(this);
            if (dz.hasClass('drop-carousel')) {
                var carousel = dz.parents("[data-ride='carousel']");
            }
            var input = dz.children('input');
            var parent = dz.parents('[data-block]');
            var dzObj;
            var clonedDz;
            var blockEl = parent.attr('data-block');
            var multiple = $(this).data('maxfiles') > 1;
            var clicable = !dz.hasClass('disabled');
            var paramName = (multiple ? 'files' : 'file'),
                maxFiles = (multiple ? $(this).data('maxfiles') : 1),
                parallelUploads = 1;

            dz.dropzone({
                url: $(this).data('source'),
                acceptedFiles: $(this).data('accept'),
                maxFilesize: $(this).data('maxsize') || 2,
                maxFiles: maxFiles,
                paramName: paramName,
                parallelUploads: parallelUploads,
                uploadMultiple: multiple,
                addRemoveLinks: clicable,
                clickable: clicable,
                autoProcessQueue: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function () {
                    clonedDz = dz.parent().clone();
                    var inputDz = dz.children('input');

                    if (input.val() && !str_contains(input.val(), '/0/')) {
                        var mockFile = {
                            name: input.data('filename'),
                            size: input.data('size'),
                            type: input.data('mime'),
                            status: Dropzone.ADDED,
                            url: input.val()
                        };

                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, input.val());
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                    }

                    this.on('addedfile', function (file) {
                        if (!empty(blockEl))
                            blockUI(blockEl);
                    });

                    this.on("sending", function (file, xhr, formData) {
                        formData.append("docType", dz.find('input[type="hidden"]').attr('id'));
                        dz.find('.dz-preview .dz-remove').addClass('dz-sending');
                    });

                    this.on("maxfilesexceeded", function (file) {
                        dzObj.removeFile(file);
                        generateNotify('Erro: ', 'Você excedeu o numero máximo de arquivos, Máximo de arquivos permitidos: ' + maxFiles, 'error');
                    });

                    this.on('error', function (file, data, xhr) {
                        if (!(this.files.length > maxFiles))
                            dzObj.removeAllFiles();

                        var maxFileSize = this.options.maxFilesize * 1024 * 1024;
                        var maxMB = bytesToSize(maxFileSize);
                        var fileMB = bytesToSize(file.size);

                        if (file.size > maxFileSize)
                            generateNotify('Erro: ', 'O arquivo excedeu o tamanho máximo permitido: (' + maxMB + ') e o tamanho dele é de ' + fileMB, 'error');

                        //Display message
                        if (!!data.message) {
                            dz.find('.dz-message').children(0)
                                .hide()
                                .after('<span>' + data.message + '</span>');
                        }
                    });

                    this.on('success', function (file, data) {
                        //Disable dropzone
                        if (data.success)
                            dzObj.disable();

                        //Set callback if exist
                        if (!!data.callback)
                            Callbacks[data.callback](data);

                        //Define input value with image
                        inputDz.val(data.filename);
                        inputDz.attr('data-mime', data.mime);
                        inputDz.attr('data-size', data.size);
                        inputDz.attr('data-filename', data.filename);
                        inputDz.attr('data-url', data.url);
                    });

                    this.on('complete', function (file, data) {
                        if (!empty(blockEl))
                            unblockUI(blockEl);

                        dz.find('.dz-preview .dz-remove').removeClass('dz-sending');

                        if (dz.hasClass('with-error'))
                            dz.removeClass('with-error');

                        if (dz.hasClass('dz-multiple')) {
                            var wrapper = dz.parent().parent();
                            var cloneDz = clonedDz.clone();
                            var input = cloneDz.find('input[type=hidden]');
                            var classDz = input.attr('id');
                            var qtd = wrapper.find('.files').length + 1;
                            var id = classDz + '-' + qtd;

                            //Remove class
                            cloneDz.find('.dropzone').removeClass(classDz).addClass(id);
                            cloneDz.find('input[type=hidden]').attr('id', id);

                            //Append on page
                            wrapper.append(cloneDz);
                            loadDropzone($('.' + id));
                        }

                        if (dz.hasClass('dz-clear-on-finish')) {
                            $(document).on("click", ".dz-remove-custom", function (e) {
                                dzObj.enable();
                                dzObj.removeAllFiles();
                                inputDz.val('');
                            });
                        }
                        if (element.hasClass('drop-carousel')) {
                            setTimeout(function () {
                                carousel.carousel('next');
                            }, 800);
                        }
                    });

                    this.on('removedfile', function (file, data) {
                        var path = input.val();
                        var keepFiles = dz.hasClass('keep-files');

                        //Remove file stored
                        if (path.length > 4 && !keepFiles && !str_contains(path, '/0/')) {
                            var data = {
                                'filename': input.data('filename'),
                                'path': input.data('path') || path
                            };

                            $.ajax({
                                url: route('default.deleteFile'),
                                type: 'DELETE',
                                data: data,
                                success: function () {
                                    var container = dz.parent().parent();
                                    var qtd = container.find('.dz-multiple').length;

                                    if (dz.hasClass('dz-multiple') && qtd > 1)
                                        dz.parent().remove();
                                }
                            });
                        }

                        dzObj.enable();
                        input.val('');
                    });
                },

                dictDefaultMessage: '<i class="material-icons font-40 m-b-10 d-block">touch_app</i> ' + dz.data('message'),
                dictFallbackMessage: 'Seu navegador não suporta envio de arquivos com drag\'n\'drop.',
                dictFallbackText: 'Use os campos abaixo para enviar seus arquivos',
                dictInvalidFileType: 'O tipo do arquivo não é aceito',
                dictFileTooBig: 'O arquivo é muito grande',
                dictResponseError: 'Ocorreu um erro ao transferir o arquivo',
                dictCancelUpload: '',
                dictCancelUploadConfirmation: 'Quer mesmo cancelar o envio?',
                dictRemoveFile: '',
                dictMaxFilesExceeded: 'Você excedeu o número máximo de arquivos'
            });

            dzObj = Dropzone.forElement(dz[0]);

            if (dz.attr('disabled') || dz.hasClass('disabled'))
                dzObj.disable();
        });
    }

    loadDropzone();

}
catch (e) {
    console.log('Dropzone não inicializado.');
}


// function()