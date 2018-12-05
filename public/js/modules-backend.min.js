/**
 * Exibe um erro no campo de formulário especificado.
 * @param {jQuery} input Campo do formulário.
 * @param {String} error Mensagem de erro.
 */
function setInputError(input, error)
{
	var target = input;
	var isSelect2 = input.hasClass('js-select');
	
	if(!input.hasClass('select2-focusser'))
	{
		if(isSelect2)
			target = input.prev();
		
		input.parents('.form-group').addClass('has-error tip');
		
		target.attr('title', error)
			.tooltip({
				placement : 'bottom',
				trigger : 'hover focus'
			});
		
		if(isSelect2)
		{
			input.change(function(){
				if(!!this.value)
				{
					removeInputError(input);
					input.unbind('change', arguments.callee);
				}
			});
		}
		
		/*
		 * Remove os erros automaticamente.
		 */
		input.bind('keyup', function(){
			removeInputError(input);
		});
	}
}

/**
 * Remove a mensagem e a formatação de erro de um campo do formulário.
 * @param {jQuery} input Campo do formulário ou expressão CSS correspondente.
 */
function removeInputError(input)
{
	input = $(input);
	
	input.removeClass('error').parents('.form-group').removeClass('has-error tip');
	input.tooltip('destroy');
	
	if(input.hasClass('js-select'))
		input.prev().tooltip('destroy');
}
/**
 * Blocks the UI so that the user does not interact while an action is
 * performed by the system.
 * @param {Object} e Element that will be locked.
 */
function blockUI(e)
{
	var isString = $.type(e) === "string";
	var $this = isString ? $(e) : e;
	var isButton = $this.is("button");
	
	if(isButton || $this.hasClass('js-submit'))
	{
		$this.attr('disabled', true)
			.attr('old-html', $this.html())
			.html('<i class="fa fa-spin fa-spinner"></i>' + ($this.hasClass('js-submit-icon-only') ? '' : ' Aguarde'));
	}
	else
	{
		
		$this.block({
			message: '<div class="loading-block">' +
						'<main>\n' +
						'    <heart>\n' +
						'        <span class=\'heartL\'></span>\n' +
						'        <span class=\'heartR\'></span>\n' +
						'        <span class=\'square\'></span>\n' +
						'    </heart>\n' +
						'    <shadow></shadow>\n' +
						'</main>' +
					'</div>',
			// theme: true,
			baseZ: 2000,
			css: {
				border: 'none',
				padding: '2px',
				backgroundColor: 'none'
			},
			overlayCSS: {
				backgroundColor: '#000',
				opacity: 0.4,
				cursor: 'wait',
				height: '100vh'
			}
		});
	}
}

/**
 * Unlocks the UI of a previously locked item.
 * @param {Object} e Element that will be unblocked.
 */
function unblockUI(e)
{
	var isString = $.type(e) === "string";
	var $this = isString ? $(e) : e;
	var isButton = $this.is("button");
	
	if(isButton || $this.hasClass('js-submit'))
	{
		$this.attr('disabled', false)
			.html($this.attr('old-html'));
	}
	else
	{
		$this.unblock();
	}
}


/**
 * Functions called when ajax returns
 * @type {Object}
 */
window.Callbacks = {
	/**
	 * Função executada antes do envio do formulário via Ajax. Deve ser
	 * sobrescrita para adicionar validações adicionais.
	 * @return {Boolean} Se retornar false o envio do formulário será
	 * cancelado. Retorna true por padrão.
	 */
	preSubmit : function()
	{
		return true;
	},
	
	/**
	 * Função executada após do envio do formulário via Ajax. Deve ser
	 * sobrescrita para adicionar comportamento adicional.
	 */
	postSubmit : function()
	{
		//
	},
	
	/**
	 * Função executada para manipular os dados do formulário que serão
	 * enviados via Ajax. Deve ser sobrescrita para adicionar comportamento
	 * adicional.
	 * @param {Array} data O array contém objetos com duas propriedades
	 * apenas: name, value.
	 * @return {Array} O array deve seguir o mesmo formato do array
	 * recebido, contendo objetos com duas propriedades: name, value.
	 */
	serializeData : function(data)
	{
		return data;
	},
	
	/**
	 * Redireciona a página para a URL definida em data.url, o usuário
	 * também tem a opção de apresentar uma mensagem ao usuário antes do
	 * redirecionamento.
	 *
	 * @param {Object} data Objeto contendo a resposta de uma chamada Ajax
	 * feita por algum formulário. Deve conter a propriedade url.
	 */
	redirect : function(data)
	{
		if(!!data.time)
		{
			if(!!data.message && !!data.type)
				showMessage(data.title, data.message, data.type);
			
			setTimeout(function(){
				if(!!data.url)
					window.location.href = data.url;
				else
					document.location.reload(true);
			}, data.time);
		}
		else
		{
			if(!!data.url)
				window.location.href = data.url;
			else
				document.location.reload(true);
		}
	},
};

/**
 * Method that will get address
 * @event Jquery#OnBlur
 * @author Luigi Oliveira <luigi.jordanio@liket.com.br>
 */
$(document).on('focusout', 'input.cep', function (ev) {
    var cep = $(this);
    var length = cep.val().length;

    if (length == 9) {
        $.ajax({
            url: dev.baseUrl + '/default/get-address',
            type: 'get',
            data: 'cep=' + cep.val(),
            success: function (data) {
                /**
                 * Get inputs elements that will changed.
                 * @type {*|jQuery|HTMLElement}
                 */
                var city = $('select[data-type="city"]');
                var district = $('input[name="district"] , input[data-type="district"] ');
                var address = $('input[name="address"] , input[data-type="address"] ');
                var state = $('select[data-type="state"]');

                //Fill latitude and longitude.
                getCoordsByCep(cep.val());

                if (data.success) {
                    var cityData = data.city;
                    var addressData = data.address;
                    var stateData = data.state;
                    var districtData = data.district || null;

                    // Set value in state
                    state.val(stateData.id).trigger('change');
                    state.parent('.form-group').removeClass('is-empty');
                    state.removeAttr('disabled');

                    // Set value in city
                    city.empty().append('<option value="' + cityData.id + '"> ' + cityData.name + '</option>');
                    city.empty().val(cityData.id).trigger('change');
                    city.parent('.form-group').removeClass('is-empty');
                    city.removeAttr('disabled');

                    // Set Address value
                    address.empty().val(addressData.address);
                    address.parent('.form-group').removeClass('is-empty');

                    // Set District value
                    district.empty().val(districtData.name);
                    district.parent('.form-group').removeClass('is-empty');
                }
                else {
                    address.removeAttr('readonly').val("").parent('.form-group').addClass('is-empty');
                    district.removeAttr('readonly').val("").parent('.form-group').addClass('is-empty');

                    generateNotify('Não foi possível autocompletar o endereço por este CEP, Por favor preencha manualmente.', 'info');

                    if (typeof  state.select2 == 'function') {
                        state.select2;
                    }

                }
            },
            error: function (data) {

            }
        })
    }
});
/**
 *
 * @param bytes
 * @returns {string}
 */
function bytesToSize(bytes)
{
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	
	if(bytes == 0)
		return '0 Byte';
	
	return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};
/**
 * Function to transform text into slug.
 * @param str Text to transform
 * @returns {string}
 */
function toSlug(str)
{
	str = str.replace(/^\s+|\s+$/g, '');
	str = str.toLowerCase();
	var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
	var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
	
	for(var i=0, l=from.length ; i<l ; i++){
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}
	
	str = str.replace(/[^a-z0-9 -]/g, '')
		.replace(/\s+/g, '-')
		.replace(/-+/g, '-');
	
	return str;
};
/**
 * Function to verify if string contains word.
 * @param str Text to verify
 * @param value Word to find
 * @returns {string}
 */
function str_contains(str, value)
{
	if(~str.indexOf(value))
		return true;
	
	return false;
};

/**
 *
 * @param str
 * @returns {string}
 */
function humanize(str)
{
	return str.trim().split(/\s+/).map(function(str){
		return str.replace(/_/g, ' ').replace(/\s+/, ' ').trim();
	}).join(' ').toLowerCase().replace(/^./, function(m){
		return m.toUpperCase();
	});
}


function empty(str)
{
	if($.trim(str) === "")
		return true;

	return false;
}


function in_array(value, arr)
{
	for(var i = 0; i < arr.length; i++)
	{
		if(arr[i] === value)
			return true;
	}
	
	return false;
}

/**
 * Decode para strings base64
 * @param str
 * @returns {*|string}
 */
function base64_decode(str)
{
	var result = '';
	
	try
	{
		result = decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
		}).join(''));
	}
	catch(e)
	{
		result = str;
	}
	
	return result;
}

/**
 * Functions called when ajax returns
 * @type {Object}
 */
window.Callbacks = {
	/**
	 * Função executada antes do envio do formulário via Ajax. Deve ser
	 * sobrescrita para adicionar validações adicionais.
	 * @return {Boolean} Se retornar false o envio do formulário será
	 * cancelado. Retorna true por padrão.
	 */
	preSubmit : function()
	{
		return true;
	},
	
	/**
	 * Função executada após do envio do formulário via Ajax. Deve ser
	 * sobrescrita para adicionar comportamento adicional.
	 */
	postSubmit : function()
	{
		//
	},
	
	/**
	 * Função executada para manipular os dados do formulário que serão
	 * enviados via Ajax. Deve ser sobrescrita para adicionar comportamento
	 * adicional.
	 * @param {Array} data O array contém objetos com duas propriedades
	 * apenas: name, value.
	 * @return {Array} O array deve seguir o mesmo formato do array
	 * recebido, contendo objetos com duas propriedades: name, value.
	 */
	serializeData : function(data)
	{
		return data;
	},
	
	/**
	 * Redireciona a página para a URL definida em data.url, o usuário
	 * também tem a opção de apresentar uma mensagem ao usuário antes do
	 * redirecionamento.
	 *
	 * @param {Object} data Objeto contendo a resposta de uma chamada Ajax
	 * feita por algum formulário. Deve conter a propriedade url.
	 */
	redirect : function(data)
	{
		if(!!data.time)
		{
			if(!!data.message && !!data.type)
				showMessage(data.title, data.message, data.type);
			
			setTimeout(function(){
				if(!!data.url)
					window.location.href = data.url;
				else
					document.location.reload(true);
			}, data.time);
		}
		else
		{
			if(!!data.url)
				window.location.href = data.url;
			else
				document.location.reload(true);
		}
	},
};

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
        $('.date').mask('00/00/0000', {'placeholder': '__/__/____'});
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
 * This event will apply the dropzone effect to any element that has the data-type dropzone attribute
 * @event Jquery#each
 * @author Luigi Oliveira <luigi.jordanio@liket.com.br>
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

                dictDefaultMessage: '<i class="material-icons display-block font-40 m-b-10">touch_app</i> ' + dz.data('message'),
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
/**
 * Event that will scroll through all tables and popular with datatables
 * @event Jquery#Each
 */
$("table[data-type='datatables']").each(function(e)
{
	var table = $(this);
	var defaultSort = 1;
	var thSort = $('th.default-sort');
	
	//Default sort
	if(thSort.length > 0)
		defaultSort = parseInt(thSort.index());
	
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
			"url": dev.baseUrl + "/plugins/dataTables/Languages/portugues-brasil.lang"
		},
		preDrawCallback: function(settings)
		{
			prettySelect('select');
			$(".dataTables_length > label").css({'width' : '70px'});
			$('.dataTables_filter input[type="search"]').attr('placeholder', 'Filtro rápido...');
		},
		initComplete: function(settings, json)
		{
			fixeActions();
		}
	});
});
/**
 * Function to verify if string contains word.
 * @param str Text to verify
 * @param value Word to find
 * @returns {string}
 */
function str_contains(str, value)
{
	if(~str.indexOf(value))
		return true;
	
	return false;
}

/**
 *
 * @param str
 * @returns {string}
 */
function humanize(str)
{
	return str.trim().split(/\s+/).map(function(str){
		return str.replace(/_/g, ' ').replace(/\s+/, ' ').trim();
	}).join(' ').toLowerCase().replace(/^./, function(m){
		return m.toUpperCase();
	});
}


function empty(str)
{
	if($.trim(str) === "")
		return true;
	
	return false;
}


function in_array(value, arr)
{
	for(var i = 0; i < arr.length; i++)
	{
		if(arr[i] === value)
			return true;
	}
	
	return false;
}

/**
 * Function to transform text into slug.
 * @param str Text to transform
 * @returns {string}
 */
function toSlug(str)
{
	str = str.replace(/^\s+|\s+$/g, '');
	str = str.toLowerCase();
	var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
	var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
	
	for(var i=0, l=from.length ; i<l ; i++){
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}
	
	str = str.replace(/[^a-z0-9 -]/g, '')
		.replace(/\s+/g, '-')
		.replace(/-+/g, '-');
	
	return str;
};
/**
 *
 * @param title
 * @param message
 * @param type
 * @param delay
 * @param close
 */
function showMessage(title, message, type, delay, close)
{
	let $delay = !empty(delay) ? delay : '5000';
	let $close = !empty(close) ? close : false;
	let $title = !empty(title) ? title : '';
	let $type = !empty(type) ? type : 'success';
	
	toastr.options = {
		"closeButton": $close,
		"debug": false,
		"newestOnTop": true,
		"progressBar": false,
		"positionClass": "toast-top-full-width",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 1000,
		"timeOut": $delay,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	
	if(!empty($message))
	{
		switch($type)
		{
			case 'error':
				toastr.error($type, $title);
				break;
			case 'warning':
				toastr.warning($type, $title);
				break;
			case 'info':
				toastr.info($type, $title);
				break;
			case 'success':
			default:
				toastr.success($type, $title);
				break;
		}
	}
}

function showModal()
{

}