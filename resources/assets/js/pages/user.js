/**
 * File for handwriting view of users.
 */

$(document).ready(function()
{
	setTimeout(
		function()
		{
			loadPermissions(dev.RoleId, '.permissions-box', dev.userId);
		}, 500
	);
	
});

$('body').on('change', '#profile', function()
{
	var valuesProfile = $(this).val();
	loadPermissions(valuesProfile, '.permissions-box');
});

/**
 * Function that will load the permissions.
 * @param {int}     roleId          - Id to Role.
 * @param {int}     userId          - Id to User.
 * @param {string}  cssSelector - css selector to be populated.
 */
function loadPermissions(roleId, cssSelector, userId = null)
{
	if(roleId)
	{
		var element = $(cssSelector) || $('.load-permission');
		var url = element.attr('data-source');
		
		if(element.length > 0)
		{
			/**
			 * Data to send.
			 * @type {Object}
			 */
			var data = {
				'role_id' : roleId,
				'user_id' : userId,
			};
			
			$.ajax({
				url: url,
				type: 'POST',
				data: data,
				success: function(data)
				{
					if(data.success)
					{
						var permissions = data.permissions;
						var baseHTML = "<ul style='list-style: none;padding: 0'>";
						var disabled = dev.showOnly ? 'disabled' : '';
						
						if(_.size(permissions) > 0)
						{
							var permissionsArray = new Array();
							for(var i = 0; i <= _.size(permissions); i++)
							{
								let permission = permissions[i];
								
								if(typeof permission !== "undefined")
								{
									var selected = (permission.selected) ? 'checked' : '';
									
									baseHTML += "<li class='w-r-50 pull-left'>";
									baseHTML += "		<div class='switch'>";
									baseHTML += "				<label class='bs-switch w-r-100'>";
									baseHTML += "						<input type='checkbox' id='id" + permission.id + "' value='" + permission.id + "' name='permissions[]' " + selected + "  " + disabled + " >";
									baseHTML += "						<span class='lever'></span>" + permission.name;
									baseHTML += "				</label>";
									baseHTML += "		</div>";
									baseHTML += "</li>";

									if(permission.selected)
										permissionsArray.push(permission.id)
								}
								
							}
							
							if(dev.showOnly)
								baseHTML += "<input type='hidden' value='[" + permissionsArray + "]' name='permissions[]'>";
							
						}
						else
						{
							baseHTML += "<li><p class='text-center'>Nenhuma permissão cadastrada nesse perfil!</p></li>";
						}
						
						baseHTML += "</ul>";
						
						$(cssSelector).html(baseHTML);
						
						if(dev.readOnly)
						{
							$("section.content :input").attr("disabled", true);
							$("section.content :input").prop("disabled", true);
						}
					}
					else
					{
						generateNotify('Erro', 'Ocorreu algum erro.', 'error');
					}
				},
				error: function(data)
				{
					console.log(data);
					generateNotify('Error:', 'Ocorreu um erro inesperado', 'error');
				}
			});
		}
		
	}
	else
	{
		console.log('Missing Parameters to execute function');
	}
}

