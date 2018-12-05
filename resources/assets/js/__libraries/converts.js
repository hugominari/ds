/**
 *
 * @param bytes
 * @returns {string}
 */
function bytesToSize(bytes)
{
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	
	if(bytes == 0)
		return '0 Byte';
	
	return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};