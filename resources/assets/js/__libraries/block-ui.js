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

