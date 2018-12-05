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