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
			
			dictDefaultMessage : '<i class="material-icons display-block font-40 m-b-10">touch_app</i> ' + dz.data('message'),
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