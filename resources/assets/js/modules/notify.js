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
	var time				= delay || 5000;
	
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
		"positionClass": "md-toast-" + from + '-' + align,
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": 500,
		"hideDuration": 1000,
		"timeOut": time,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	
	toastr[type](message);
}
