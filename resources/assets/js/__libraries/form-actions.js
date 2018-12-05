/**
 *
 */
$(document).on("click", ".js-submit", function(e)
{
	alert('asdasda');
	e.preventDefault();
	let submit = $(this);
	let form = $('form.ajax-form');
	let url = form.attr("action");
	let data = Callbacks.serializeData(form.serializeArray());
	
	console.log('enviando');
	
	if(Callbacks.preSubmit())
	{
		axios({
			method: "POST",
			url: url,
			data: data,
		})
		.then(response => {
			console.log(response);
			
			if(!!response.callback)
				Callbacks[response.callback](data);
			
			if(!!data.message)
				showMessage(data.title, data.message, data.type)
		})
		.catch(e => {
			console.log(e);
			
			if(!!e.message)
				showMessage(data.title, data.message, data.type)
		});

		Callbacks.postSubmit();
	}
});