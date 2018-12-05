/**
 * Function to verify if string contains word.
 * @param str Text to verify
 * @param value Word to find
 * @returns {string}
 */
function str_contains(str, value)
{
	if(~str.indexOf(value))
		return true;
	
	return false;
}

/**
 *
 * @param str
 * @returns {string}
 */
function humanize(str)
{
	return str.trim().split(/\s+/).map(function(str){
		return str.replace(/_/g, ' ').replace(/\s+/, ' ').trim();
	}).join(' ').toLowerCase().replace(/^./, function(m){
		return m.toUpperCase();
	});
}


function empty(str)
{
	if($.trim(str) === "")
		return true;
	
	return false;
}


function in_array(value, arr)
{
	for(var i = 0; i < arr.length; i++)
	{
		if(arr[i] === value)
			return true;
	}
	
	return false;
}

/**
 * Function to transform text into slug.
 * @param str Text to transform
 * @returns {string}
 */
function toSlug(str)
{
	str = str.replace(/^\s+|\s+$/g, '');
	str = str.toLowerCase();
	var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
	var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
	
	for(var i=0, l=from.length ; i<l ; i++){
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}
	
	str = str.replace(/[^a-z0-9 -]/g, '')
		.replace(/\s+/g, '-')
		.replace(/-+/g, '-');
	
	return str;
};