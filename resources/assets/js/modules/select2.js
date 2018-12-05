/**
 * Transforms the select passed by the 'e' parameter into an improved select using
 *  the jQuery plugin Select2.
 * @param {jQuery} e Expressão jQuery.
 * @author Hugo Minari <dev.hugo.influencer@gmail.com>
 */
try
{
	function prettySelect(e)
	{
		$(e).each(function()
		{
			//Default options
			var input = $(this);
			
			
			// input.select2('destroy');
			
			var opts = {
				minimumResultsForSearch: -1,
				theme: "material",
				placeholder: "Selecione uma opção",
				language: "pt-BR",
				escapeMarkup: function(markup){
					return markup;
				}
			};
			
			//If populate with ajax
			if(!!input.data('source'))
			{
				opts.ajax = {
					url : input.data('source'),
					dataType : 'json',
					type : 'POST',
					cache : true,
					processResults: function(data){
						input
							.empty()
							.select2({data : data.items})
							.select2('open');
						
						unblockUI('.content-wrapper');
					}
				};
			}
			
			if(!!input.data('options'))
			{
				input
					.select2({data : input.data('options')});
					// .select2('open').trigger('change');
			}
			
			//On change, populate second
			if(!!input.data('second') || !!input.data('third'))
			{
				input.bind("change", function()
				{
					var secondary = input.data('second') || input.data('third');
					var inputSecond = $(secondary);
					var autoComplete = inputSecond.data('type') == 'autocomplete';
					
					var data = {
						'value': input.select2('val'),
						'second': input.data('second'),
						'third': input.data('third')
					};
					
					$.ajax({
						dataType: 'json',
						type: 'POST',
						url: inputSecond.data('source'),
						data: data,
						success: function(data)
						{
							console.log('deu certo');
							inputSecond.removeAttr('disabled');
							unblockUI('.content-wrapper');
							
							if(autoComplete)
							{
								inputSecond.autocomplete({
									source: data.items
								});
							}
							else
							{
								inputSecond
									.empty()
									.select2({data : data.items})
									.select2('open');
							}
						},
						error: function(){
							unblockUI('.content-wrapper');
						}
					});
				});
			}
			
			//If select is multiple
			if(input.attr('multiple'))
			{
				opts.tags = true;
				opts.multiple = true;
				opts.tokenSeparators = [",", " "];
				opts.minimumResultsForSearch = -1;
				
				setTimeout(function(){
					input.parents('div.form-group')
						.find('.select2-search__field')
						.css({
							'width': '100px',
							'background': 'transparent none repeat scroll 0% 0%',
							'outline': 'none',
							'border' : 'none',
							'margin' : '0 0 -30px 0'
						})
						.removeAttr('placeholder');
					
					input.parents('div.form-group')
						.find('.select2-selection__rendered')
						.css({
							'margin-bottom' : '0'
						});
				}, 300);
			}
			
			//Enable search in select2
			if(input.data('search') || input.hasClass('js-select'))
			{
				opts.minimumResultsForSearch = null;
				$(".select2-search__field").show();
			}
			
			try
			{
				input.select2(opts);
				$(".select2-selection__arrow").addClass("material-icons").html("arrow_drop_down");
			}
			catch(ex)
			{
				console.log('prettySelect: ' + ex);
			}
		});
	}
}
catch(e)
{
	console.log('Select2 não inicializado.');
}