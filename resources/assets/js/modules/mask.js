/**
 * Masks
 */

try
{
	function loadMasks()
	{
        var PhoneMaskBehavior = function(val)
        {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        }, options = {
            onKeyPress: function(val, e, field, options)
            {
                field.mask(PhoneMaskBehavior.apply({}, arguments), options);
            }
        };
        
        var CpfCnpjMaskBehavior = function(val)
        {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
        }, cpfCnpjpOptions = {
            onKeyPress: function(val, e, field, cpfCnpjpOptions)
            {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), cpfCnpjpOptions);
            }
        };
        
        $('.cpfcnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
        $('.cep').mask('00000-000');
        $('.coord').mask('~00.00######', {'translation': {'~': {'pattern': /-/, optional: true}}});
        $('.date').mask('00/00/0000');
        $('.datetime').mask('00/00/0000 00:00:00');
        $('.time').mask('00:00:00');
        $('.tel').mask('(00) 0000-0000');
        $('.cel').mask(PhoneMaskBehavior, options);
        $('.money').mask("#.##0,00", {reverse: true});
        $('.percent').mask('000,00', {reverse: true});
        $('.letter').mask('Z', {translation: {'Z': {pattern: /[a-zA-Z ]/, recursive: true}}});
        $('.number').mask('N', {translation: {'N': {pattern: /[0-9]/, recursive: true}}});
        $('.slug').mask('S', {translation: {'S': {pattern: /[a-z0-9_.]/, recursive: true}}});
        $('.agency-mask').mask('0000-0');
        $('.account-mask').mask('000000000000-0', {reverse: true});
    }
	
	loadMasks();
}
catch(e)
{
	console.log('Inputmask não inicializado.');
}