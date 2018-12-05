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