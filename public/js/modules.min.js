/**
 * Configure the ajax requests
 */
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

/**
 * When ajax sent
 */
$(document).ajaxSend(function(e, xhr, settings)
{
	var isDataTableSearch = e.target.activeElement.closest('.dataTables_filter');
	var canBlock = true;
	
	//Set urls for non block
	var urlsNonBlock = [
		'users/verify-notify'
	];
	
	//Check if the current url is in the array
	$.each(urlsNonBlock, function(index, value)
	{
		var url = $(location).attr('href');
		var requested = settings.url;
		
		if(~url.indexOf(value) || ~requested.indexOf(value))
		{
			canBlock = false;
		}
	});
	
	//Block
	if(!isDataTableSearch && canBlock)
	{
		blockUI('.content-wrapper', '.login-box', '.content-wrappers');
	}
});

/**
 * When ajax completed
 */
$(document).ajaxComplete(function(e, xhr, settings)
{
	unblockUI('.content-wrapper', '.login-box', '.content-wrappers');
});

/**
 * When ajax get error
 */
$(document).ajaxError(function(e, xhr, settings)
{
	unblockUI('.content-wrapper', '.login-box', '.content-wrappers');
});
/**
 * Masks
 */

try
{
	function loadMasks()
	{
        var PhoneMaskBehavior = function(val)
        {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        }, options = {
            onKeyPress: function(val, e, field, options)
            {
                field.mask(PhoneMaskBehavior.apply({}, arguments), options);
            }
        };
        
        var CpfCnpjMaskBehavior = function(val)
        {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
        }, cpfCnpjpOptions = {
            onKeyPress: function(val, e, field, cpfCnpjpOptions)
            {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), cpfCnpjpOptions);
            }
        };
        
        $('.cpfcnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.cep').mask('00000-000');
        $('.coord').mask('~00.00######', {'translation': {'~': {'pattern': /-/, optional: true}}});
        $('.date').mask('00/00/0000');
        $('.datetime').mask('00/00/0000 00:00:00');
        $('.time').mask('00:00:00');
        $('.tel').mask('(00) 0000-0000');
        $('.cel').mask(PhoneMaskBehavior, options);
        $('.money').mask("#.##0,00", {reverse: true});
        $('.percent').mask('000,00', {reverse: true});
        $('.letter').mask('Z', {translation: {'Z': {pattern: /[a-zA-Z ]/, recursive: true}}});
        $('.number').mask('N', {translation: {'N': {pattern: /[0-9]/, recursive: true}}});
        $('.slug').mask('S', {translation: {'S': {pattern: /[a-z0-9_.]/, recursive: true}}});
        $('.agency-mask').mask('0000-0');
        $('.account-mask').mask('000000000000-0', {reverse: true});
    }
	
	loadMasks();
}
catch(e)
{
	console.log('Inputmask não inicializado.');
}
/**
 * Function that generates custom modals.
 *
 * @param {string}  title                       - Title of Modal
 * @param {string}  text                        - Message of Modal
 * @param {string}  type            [optional]  - Type of Modal (success, error, warning, info, question)
 * @param {boolean} callback        [optional]  - Function to call after confirm
 * @author Hugo Minari <hugo.minari@liket.com.br>
 */
function generateModal(title, text, type, callback)
{
	var title       = title || "";
	var text        = text || "";
	var type        = type || "info";
	var extra		= {};
	var defaultConf = {
		title: title,
		type: type,
		html: text,
		width: '50rem',
		padding: '3em',
	};
	
	//Extra config to callbacks
	if(!!callback)
	{
		extra = {
			showCancelButton: true,
			confirmButtonText: "Confirmar",
			cancelButtonText: "Cancelar"
		};
	}

	var config = $.extend(defaultConf, extra);
	
	swal(config).then(function(result)
	{
		if(result.value && !!callback)
			callback(true);
		else
			callback(false);
	});
}
/**
 * Function that generates custom alerts and notifications.
 *
 * @param {string} title        [optional]  - Title of Notify
 * @param {string} message      [optional]  - Message of Notify
 * @param {string} type         [optional]  - Type of Notify
 * @param {string} link         [optional]  - Redirect Link of Notify
 * @param {string} positionX    [optional] - Align of Notify (center,left,right)
 * @param {string} positionY    [optional] - Position of Notify (top,bottom)
 * @return void
 */
function generateNotify(title, message, type, link, from, align, delay)
{
	//Trait the received data
	title       = title     || "";
	message     = message   || "";
	type        = type      || "info";
	link        = link      || null;
	align   	= align  	|| "right";
	from  		= from  	|| "bottom";
	
	//Create vars
	var animate     = null;
	var icon        = 'fa ';
	var actions     = $('.js-fixed-actions').length || null;
	var y           = (!!actions) ? 75 : 10;
	
	//Trait new vars
	switch(type)
	{
		case 'warning':
			animate  = 'animated fadeInUp';
			icon    += 'fa-exclamation-triangle';
			break;
		case 'danger':
			animate  = 'animated fadeInUp';
			icon    += 'fa-times-circle';
			break;
		case 'success':
			animate  = 'animated fadeInUp';
			icon    += 'fa-check-circle';
			break;
		default:
			animate  = 'animated fadeInUp';
			icon    += 'fa-info-circle';
	}
	
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 1000,
		"timeOut": delay || 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	
	toastr[type](message);
}

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
function dataURItoBlob(dataURI)
{
	var byteString = atob(dataURI.split(',')[1]);
	var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
	var ab = new ArrayBuffer(byteString.length);
	var dw = new DataView(ab);
	
	for(var i = 0; i < byteString.length; i++)
		dw.setUint8(i, byteString.charCodeAt(i));
	
	return new Blob([ab], {type: mimeString});
}

try
{
	// modal window template
	var modalTemplate = '' +
		'<div id="modal-cropper" class="modal fade" tabindex="-1" role="dialog">' +
			'<div class="modal-dialog" role="document">' +
				'<div class="modal-content">' +
					'<div class="modal-header">' +
						'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
						'<h4 class="modal-title">Recorte de imagem</h4>' +
					'</div>' +
					'<div class="modal-body">' +
						'<div class="image-container"></div>' +
					'</div>' +
					'<div class="modal-footer">' +
						'<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>' +
						'<button type="button" class="btn btn-primary m-r-18 crop-upload">Salvar</button>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'';
	
	// initialize dropzone
	Dropzone.autoDiscover = false;
	
	$("[data-type='dropzone-crop']").each(function(e){
		var dz = $(this);
		var dzObj;
		var clonedDzC;
		var input = dz.children('input');
		var multiple = $(this).data('maxfiles') > 1;
		var maxfile = $(this).data('maxfiles');
		var blockEl = dz.closest('.box');
		var enabled = !dz.hasClass('disabled');
		
		dz.dropzone({
			autoProcessQueue	: false,
			url 				: dz.data('source'),
			acceptedFiles 		: 'image/*',
			maxFiles 			: 1,
			uploadMultiple 		: multiple,
			addRemoveLinks 		: dz.hasClass('disabled') ? false : true,
			clickable 			: enabled,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			init : function()
			{
				clonedDzC = dz.parent().clone();

				if(dz.hasClass('disabled'))
					dz.unbind('click');
				
				if(input.val() && !str_contains(input.val(), '/0/'))
				{
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
				
				this.on('thumbnail', function(file)
				{
					//If file has cropped
					if(file.cropped)
						return;
					
					//If file is too small width
					if(file.width < 300 || file.height < 300)
					{
						generateNotify('Atenção:', 'Esta imagem é muito pequena e a qualidade ficará comprometida após este procedimento, por favor, escolha outra imagem!', 'danger', '', 'bottom', 'right');
						dz.addClass('with-error');
						this.removeFile(file);
						return;
					}
					
					//Prepare the crop
					var cachedFilename = file.name;
					this.removeFile(file);
					var $cropperModal = $(modalTemplate);
					var $uploadCrop = $cropperModal.find('.crop-upload');
					var $img = $('<img />');
					var reader = new FileReader();
					
					//Configure the cropper
					reader.onloadend = function()
					{
						$cropperModal.find('.image-container').html($img);
						$img.attr('src', reader.result);
						
						$img.cropper({
							aspectRatio: 1 / 1,
							autoCropArea: 1,
							movable: true,
							cropBoxResizable: true,
							minContainerWidth: 600,
							minContainerHeight: 600,
							minCanvasHeight: 600,
							minCanvasWidth: 600,
						});
					};
					
					//Open modal
					reader.readAsDataURL(file);
					$cropperModal.one('shown.bs.modal', function(e){
						var widthModal = $cropperModal.find('.cropper-container.cropper-bg').outerWidth() + 50;
						$('.modal-dialog').width(widthModal);
					}).modal('show') ;
					
					//On button upload has clicked
					$uploadCrop.on('click', function()
					{
						var blob = $img.cropper('getCroppedCanvas').toDataURL();
						var newFile = dataURItoBlob(blob);
						newFile.cropped = true;
						newFile.name = cachedFilename;
						dzObj.addFile(newFile);
						dzObj.processQueue();
						$cropperModal.modal('hide');
					});
				});
				
				this.on('addedfile', function(file)
				{
					// dz.removeClass('dz-clickable alert alert-error').find('.dz-message').hide();
					// dz.find('.dz-message').children(0).show().next().hide();
					// dz.find('.alert').hide();
				});
	
				this.on("sending", function(file, xhr, formData)
				{
					// formData.append("docType", dz.find('input[type="hidden"]').attr('id'));
					dz.find('.dz-preview .dz-remove').addClass('dz-sending');
					// dz.find('.dz-preview .dz-remove').prepend('<i class="fa fa-hand-paper-o m-r-5" aria-hidden="true"></i>');
					// dz.find('.dz-preview .dz-remove').css({'zIndex' : 2500, 'position' : 'relative'});
					// dz.find('.dz-preview .dz-remove > *').css({'zIndex' : 2500, 'position' : 'relative'});
				});
				
				this.on('error', function(file, data, xhr)
				{
					//Remove files
					unblockUI(blockEl);
					dzObj.removeAllFiles();
					var maxFileSize = this.options.maxFilesize * 1024 * 1024;
					var maxMB = bytesToSize(maxFileSize);
					var fileMB = bytesToSize(file.size);
					
					if(file.size > maxFileSize)
						generateNotify('Erro: ', 'O arquivo excedeu o tamanho máximo permitido: (' + maxMB + ') e o tamanho dele é de ' + fileMB, 'error');
					
					//Display message
					if(!!data.message)
					{
						dz.find('.dz-message').children(0)
							.hide()
							.after('<span>' + data.message + '</span>');
					}
					
					//Remove files
					dzObj.removeAllFiles();
					dz.addClass('with-error');
				});
				
				this.on('success', function(file, data)
				{
					//Disable dropzone
					if(data.success)
						dzObj.disable();
					
					//Set callback if exist
					if(!!data.callback)
						Callbacks[data.callback](data);
					
					//Define input value with image
					input.val(data.filename);
					input.attr('data-mime', data.mime);
					input.attr('data-size', data.size);
					input.attr('data-filename', data.filename);
					input.attr('data-url', data.url);
				});
				
				this.on('complete', function(file, data)
				{
					unblockUI(blockEl);
					dz.find('.dz-preview .dz-remove').removeClass('dz-sending');
					
					if(dz.hasClass('with-error'))
						dz.removeClass('with-error');
					
					if(dz.hasClass('dz-multiple'))
					{
						var wrapper = $('.form-group.files:first').parent();
						var cloneDz = clonedDzC.clone();
						var input = clonedDz.find('input[type=hidden]');
						var classDz = input.attr('id');
						var qtd = $('.form-group.files').length + 1;
						var id = classDz + '-' + qtd;
						
						//Remove class
						cloneDz.find('.dropzone').removeClass(classDz).addClass(id);
						cloneDz.find('input[type=hidden]').attr('id', id);
						
						//Append on page
						wrapper.append(cloneDz);
						loadDropzone($('.' + id));
					}
					
					if(dz.hasClass('dz-clear-on-finish'))
					{
						$(document).on("click", ".dz-remove-custom", function(e)
						{
							dzObj.enable();
							dzObj.removeAllFiles();
							input.val('');
						});
					}
				});
				
				this.on('removedfile', function(file, data)
				{
					var path = input.val();
					var keepFiles = dz.hasClass('keep-files');
					
					//Remove file stored
					if(path.length > 4 && !keepFiles && !str_contains(path, '/0/'))
					{
						var data = {
							'filename' : input.data('filename'),
							'path' : input.data('path') || path
						};
						
						$.ajax({
							url: route('default.deleteFile'),
							type: 'DELETE',
							data: data,
							success: function()
							{
								if(dz.hasClass('dz-multiple'))
									dz.parent().remove();
							}
						});
					}
					
					dz.addClass('dz-clickable').find('.dz-message').show();
					dz.find('.dz-message').children(0).show().next().show();
					dz.find('.alert').hide();
					dzObj.enable();
					input.val('');
				});
			},
			
			dictDefaultMessage : '<i class="material-icons d-block font-40 m-b-10">touch_app</i> ' + dz.data('message'),
			dictFallbackMessage : 'Seu navegador não suporta envio de arquivos com drag\'n\'drop.',
			dictFallbackText : 'Use os campos abaixo para enviar seus arquivos',
			dictInvalidFileType : 'O tipo do arquivo não é aceito',
			dictFileTooBig : 'O arquivo é muito grande',
			dictResponseError : 'Ocorreu um erro ao transferir o arquivo',
			dictCancelUpload : '',
			dictCancelUploadConfirmation : 'Quer mesmo cancelar o envio?',
			dictRemoveFile : '',
			dictMaxFilesExceeded : 'Você excedeu o número máximo de arquivos'
		});
		
		dzObj = Dropzone.forElement(dz[0]);
		
		if(dz.attr('disabled') || dz.hasClass('disabled'))
			dzObj.disable();
	});
	
}
catch(e)
{
	console.log('Dropzone não inicializado.');
}
const wrapper = $('.js-filter-box');
const lineFilter = wrapper.children('.row.line').clone();
const form = $('#form-filter');

//Constants
const FILTER_EQUAL                      = '1';
const FILTER_CONTAINS                   = '2';
const FILTER_NOT_EQUAL                  = '3';
const FILTER_START_WITH                 = '4';
const FILTER_END_WITH                   = '5';
const FILTER_GREATER_THAN               = '6';
const FILTER_GREATER_OR_EQUAL           = '7';
const FILTER_LESS_THAN                  = '8';
const FILTER_LESS_OR_EQUAL              = '9';
const FILTER_DATE_GREATER_THAN          = '10';
const FILTER_DATE_LESS_THAN             = '11';

/**
 * Button to add filter
 */
$('.js-add-filter').on('click', function()
{
	//Clean the clone
	var newLine = lineFilter.clone();
	newLine.find('.js-add-filter')
		.addClass('js-remove-filter')
		.removeClass('js-add-filter')
		.find('.fa-plus')
		.addClass('fa-minus')
		.removeClass('fa-plus');

	//Append
	newLine.appendTo(wrapper);
	// prettySelect('select');
	// loadMasks();
});

/**
 * Button to remove filter
 */
$(document).on('click','.js-remove-filter', function(){
	$(this).parents('.row.line').remove();
});

/**
 * Remove operators dont match with the column selected
 */
$('[name*=column]').on('change', function(){
	console.log($(this));
	loadFilterOperators($(this));
});

/**
 * Button to apply filter and refresh table.
 */
$('.js-filter').on('click', function()
{
	var data = {'filter' : getFilters()};
	refreshDatatables(data);
});

/**
 * Button to clear filters and refresh table eith all rows
 */
$('.clear-filter').on('click', function(e)
{
	refreshDatatables('null');

	$('.row.line:not(:first)').remove();
	$('.row.line :input:not([data-name=plus])').val('').trigger('change');
});


/**
 * Load operator supported by column selected
 * @param column
 */
function loadFilterOperators(column)
{
	//Define vars
	var type = column.children('option:selected').attr('data-type');
	var values = column.children('option:selected').attr('data-values');

	var line = column.parents('.row.line');

	var operator = line.find('[name^=operator]');
	var operatorChilds = operator.children('option');

	var valueInput = line.find('input[name^=value]');
	var valueSelect = line.find('select[name^=value]');

	// //Remove select2
	// if(valueSelect.length > 0)
	// 	$('.fix-select').find('*').not('input[name^=value]').remove();
	//
	// //Reset input
	// valueInput.removeAttr('disabled')
	// 	.removeClass('number data date')
	// 	.prop('type', 'text')
	// 	.unmask()
	// 	.empty()
	// 	.show();
	//
	// operator.val('').trigger('change');
	//
	switch(type)
	{
		case 'number':
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_LESS_THAN,
					FILTER_GREATER_THAN,
					FILTER_LESS_OR_EQUAL,
					FILTER_GREATER_OR_EQUAL,
					FILTER_EQUAL
				];

				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});

			valueInput.addClass('number');
			break;

		case 'select':
			let selectVals = $('<select/>').attr({'name' : 'value[]', 'data-name' : 'value'});
			let valuesText = JSON.parse(values);
			let objValues = [];

			//Disable operators
			operatorChilds.each(function()
			{
				let value = $(this).val();
				if(value !== FILTER_EQUAL)
					$(this).attr('disabled', true);
				else
					$(this).removeAttr('disabled').prop('selected', true);
			});

			//Generate data to select2
			for(let i = 0; i < valuesText.length; i++)
				objValues.push({'id' : valuesText[i].value, 'text' : valuesText[i].label});

			selectVals.select2({data: objValues});
			valueInput.before(selectVals).attr('disabled', true).hide();
			break;

		case 'date':
		case 'datetime':
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_DATE_GREATER_THAN,
					FILTER_DATE_LESS_THAN,
					FILTER_EQUAL
				];
				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});

			valueInput.prop('type', 'date');
			break;

		default:
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_EQUAL,
					FILTER_CONTAINS,
					FILTER_NOT_EQUAL,
					FILTER_START_WITH,
					FILTER_END_WITH
				];

				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});
	}
	//
	// //Fix masks an select2
	prettySelect('select');
	loadMasks();
}

/**
 * Get columns of table to set on datatables
 * @param table
 * @returns {Array}
 */
function getColumns(table)
{
	var columns = table.find('thead > tr > th');
	var objColumns = [];

	//Define columns
	columns.each(function(index, value)
	{
		var column = {
			'data': $(this).data('slug'),
			'name': $(this).data('slug')
		};

		objColumns.push(column);
	});

	return objColumns;
}

/**
 * Each all filters configured an send the query to controller
 * @returns {Array}
 */
function getFilters()
{
	var data = [];

	$.each($('.row.line'), function()
	{
		var line = $(this);
		data.push({
			'column' : line.find('[data-name=column]:not(:disabled)').val(),
			'operator' : line.find('[data-name=operator]:not(:disabled)').val(),
			'value' : line.find('[data-name=value]:not(:disabled)').val(),
			'plus' : line.find('[data-name=plus]:not(:disabled)').val()
		});
	});

	return data;
}

/**
 * Send request to controller make the filter and refresh datatables with new rows
 * @param table
 * @param data
 */
function refreshDatatables(data)
{
	var url = form.attr('action');
	var table = $('[data-type="datatables"]:first');

	table.dataTable({
		paging: true,
		destroy: true,
		DeferRender: true,
		serverSide: false,
		processing: true,
		columns: getColumns(table),
		columnDefs: [{
			targets: 'no-sort',
			orderable: false
		}],
		language: {
			"url": dev.baseUrl + "/plugins/dataTables/Languages/portugues-brasil.lang"
		},
		ajax: {
			url: url,
			type: "GET",
			data: data
		},
		fnDrawCallback: function(){
			// prettySelect('select');
			fixeActions();
		}
	});
}
/**
 * Event that will scroll through all tables and popular with datatables
 * @event Jquery#Each
 */
try
{
	$("table[data-type='datatables']").each(function(e)
	{
		var table = $(this);
		var defaultSort = 1;
		var thSort = $('th.default-sort');
		
		//Default sort
		if(thSort.length > 0)
			defaultSort = parseInt(thSort.index());
		
		console.log(getColumns(table));
		
		table.dataTable({
			columns: getColumns(table),
			ajax: table.attr('data-source'),
			paging: true,
			responsive: true,
			serverSide: true,
			processing: false,
			DeferRender: true,
			columnDefs: [
				{
					targets: 'no-sort',
					orderable: false,
				},
				{
					searchable    : false,
					targets     : 'no-filter'
				}
			],
			order: [[defaultSort, 'asc']],
			language: {
				"url": dev.baseUrl + "/plugins/datatables/Languages/portugues-brasil.lang"
			},
			preDrawCallback: function(settings)
			{
				var tableId = '#' + $(this).attr('id');
				var tableObj = $(tableId);
				
				tableObj.DataTable();
				$(tableId + '_wrapper').find('label').each(function () {
					$(this).parent().append($(this).children());
				});
				$(tableId + '_wrapper .dataTables_filter').find('input').each(function () {
					$(this).find('input').attr("placeholder", "Filtro rápido");
					$(this).find('input').removeClass('form-control-sm');
				});
				$(tableId + '_wrapper .dataTables_length').addClass('d-none');
				$(tableId + '_wrapper .dataTables_filter').addClass('md-form');
				$(tableId + '_wrapper .dataTables_filter').find('label').remove();
			},
			initComplete: function(settings, json)
			{
				fixeActions();
			}
		});
	});
}catch (e)
{
	console.log('');
}
/**
 * Function to send the form with ajax.
 */
$(document).on("click", ".js-submit", function (e) {
    e.preventDefault();
    var submit = $(this);
    var form = $(this).parents('form.ajax-form');

    if (Callbacks.preSubmit()) {
        //CLean errors
        $('.form-group').removeClass('has-error').find('span.text-danger').remove();
	
		var ckfix = $('.ckeditor').length;
		if(ckfix > 0)
			CKupdate();

        if (submit.hasClass('block-body')) {
            blockUI('body');
        } else {
            submit
                .attr('disabled', true)
                .attr('old-html', submit.html())
                .html('<i class="fa fa-spin fa-spinner"></i>' + (submit.hasClass('js-submit-icon-only') ? '' : ' Aguarde'));
        }

        //Send form
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form.attr("action"),
            data: Callbacks.serializeData(form.serializeArray()),
            success: function (data) {
                var original = data.original;

                if (original)
                    data = original;

                if (data.success) {
                    if (!!data.callback)
                        Callbacks[data.callback](data);
                    else if (!!data.message)
                        generateNotify(data.title, data.message, data.type);

                    $('.clear-inputs').trigger('click');
                    form.trigger('reset');

                    if ($('[data-type="datatables"]').length > 0)
                        $('[data-type=datatables]').DataTable().ajax.reload();
  
                  try
                  {
                    $('#makeAttendance').modal('hide');
                  }
                  catch (e)
                  {
                    console.log('');
                  }
                }
            },
            error: function (jqXhr, json, errorThrown) {
                //Get errors
                var response = jqXhr.responseJSON;

                if (!!response) {
                    response = response.errors;

                    //Display errors on inputs
                    $.each(response, function (index, value) {
                        var input = $('#' + index);

                        if (input.length < 1)
                            input = $('[name=' + index + ']');

                        var boxError = input.parents('.form-group, .md-form');
                        var type = input.attr('type');
                        var isDropzone = boxError.find('.dropzone').length > 0;

                        if (isDropzone)
                            boxError.find('.dropzone').addClass('with-error');
                        else
                            boxError.addClass('has-error');

                        //Inputs Hidden
                        if (input.hasClass('hide') || !!input.attr('data-error')) {
                            var elementError = input.attr('data-error');

                            if (elementError)
                                $(elementError).css('border-color', 'red');
                        }

                        if (type == 'checkbox' || type == 'radio') {
                            boxError.find('.span-error').remove();
                            boxError.append(
                                '<span class="text-danger d-block span-error">'
                                + '<i class="fa fa-exclamation-circle m-r-5" aria-hidden="true"></i>'
                                + value
                                + '</span>'
                            );
                        }
                        else {
                            boxError.find('.span-error').remove();
                            boxError.append(
                                '<span class="text-danger d-block span-error">'
                                + '<i class="fa fa-exclamation-circle m-r-5" aria-hidden="true"></i>'
                                + value
                                + '</span>'
                            );
                        }
                    });

                    //Focus input error an scroll to
                    var haveError = $('.has-error').length;

                    if (haveError > 0) {
                        var firstInputError = $(".has-error").first();
                        
                        firstInputError.find(':input:not(select)').focus();

                        $('html, body').animate({
                            scrollTop: firstInputError.offset().top - 80
                        }, 1000);
                    }
                }

                //Unblock
                if (submit.hasClass('block-body')) {
                    unblockUI('body');
                } else {
                    submit
                        .attr('disabled', false)
                        .html(submit.attr('old-html'));
                }
            },
            complete: function () {
                //Unblock
                if (submit.hasClass('block-body')) {
                    unblockUI('body');
                } else {
                    submit
                        .attr('disabled', false)
                        .html(submit.attr('old-html'));
                }
            }
        });

        Callbacks.postSubmit();
    }
});

/**
 * This function will delete the record.
 *
 * @param {int}         - id to record.
 * @param {string}      - table to record.
 */
$(document).on("click", ".js-delete", function (e) {
    e.preventDefault();
    var deleteUrl = $(this).attr('href');

    if (deleteUrl) {
        generateModal(
            'Confirmar exclusão',
            'Você deseja realmente excluir este registro?',
            'info',
            function (callback) {
                if (callback) {
                    let data = {
                       'id' : $('#id').val(),
                       'type' : $('#type').val(),
                       'model' : $('#model').val(),
                    };

                    $.ajax({
                        url: deleteUrl,
                        dataType: 'json',
                        type: 'DELETE',
                        data: data,
                        success: function (data) {
                            $('.clear-inputs').trigger('click');
                            $('[data-type=datatables]').DataTable().ajax.reload();
                            generateNotify(data.title, data.message, data.type);
                        },
                        error: function (data) {
                            generateNotify(data.title, data.message, data.type);
                        }
                    });
                }
            }
        );
    }
    else {
        console.log('Missing Parameters to execute function');
    }
});

/**
 * Clear all inputs in the form
 * @event Jquery#onClick
 */
$(document).on("click", ".clear-inputs, [type=reset]", function (e) {
    e.preventDefault();
    var form = $(this).closest('form');
    var id = $('#id').val();
    var notClear = $('#id:not(".clear")');
    form.trigger("reset");

    if (id && notClear)
        notClear.val(id);
});

/**
 * Funcao para fixa o texto do ckeditor
 * @constructor
 */
function CKupdate()
{
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}