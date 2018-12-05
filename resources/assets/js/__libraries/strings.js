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
};

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
 * Decode para strings base64
 * @param str
 * @returns {*|string}
 */
function base64_decode(str)
{
	var result = '';
	
	try
	{
		result = decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
		}).join(''));
	}
	catch(e)
	{
		result = str;
	}
	
	return result;
}
