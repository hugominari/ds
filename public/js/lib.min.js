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
	
	if(!$this.length)
		$this = $('body');
	
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
	
	if(!$this.length)
		$this = $('body');
	
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
				generateNotify(data.title, data.message, data.type);
			
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
	
	/**
	 *
	 */
	deleteFile: function deleteFile(data, callback) {
		
		$.ajax({
			url: route('default.deleteFile'),
			type: 'DELETE',
			data: data,
			success: function success(response)
			{
				if(response.success)
				{
					if(!!callback)
						callback(true);
				}
			},
			error: function(response)
			{
				callback(false);
			}
		});
	}
};

/**
 * Method that will get address
 * @event Jquery#OnBlur
 */
$(document).on('focusout', 'input.cep', function (ev) {
    var cep = $(this);
    var length = cep.val().length;

    if(length == 9)
    {
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

                    if (typeof state.select2 == 'function')
                        state.select2;
                }
            },
            error: function (data) {

            }
        })
    }
});
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
