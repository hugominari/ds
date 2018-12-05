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