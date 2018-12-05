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
		//
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
				showMessage(data.title, data.message, data.type);
			
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
};
