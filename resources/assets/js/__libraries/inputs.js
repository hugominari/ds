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