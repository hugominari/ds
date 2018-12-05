const wrapper = $('.js-filter-box');
const lineFilter = wrapper.children('.row.line').clone();
const form = $('#form-filter');

//Constants
const FILTER_EQUAL                      = '1';
const FILTER_CONTAINS                   = '2';
const FILTER_NOT_EQUAL                  = '3';
const FILTER_START_WITH                 = '4';
const FILTER_END_WITH                   = '5';
const FILTER_GREATER_THAN               = '6';
const FILTER_GREATER_OR_EQUAL           = '7';
const FILTER_LESS_THAN                  = '8';
const FILTER_LESS_OR_EQUAL              = '9';
const FILTER_DATE_GREATER_THAN          = '10';
const FILTER_DATE_LESS_THAN             = '11';

/**
 * Button to add filter
 */
$('.js-add-filter').on('click', function()
{
	//Clean the clone
	var newLine = lineFilter.clone();
	newLine.find('.js-add-filter')
		.addClass('js-remove-filter')
		.removeClass('js-add-filter')
		.find('.fa-plus')
		.addClass('fa-minus')
		.removeClass('fa-plus');

	//Append
	newLine.appendTo(wrapper);
	// prettySelect('select');
	// loadMasks();
});

/**
 * Button to remove filter
 */
$(document).on('click','.js-remove-filter', function(){
	$(this).parents('.row.line').remove();
});

/**
 * Remove operators dont match with the column selected
 */
$('[name*=column]').on('change', function(){
	console.log($(this));
	loadFilterOperators($(this));
});

/**
 * Button to apply filter and refresh table.
 */
$('.js-filter').on('click', function()
{
	var data = {'filter' : getFilters()};
	refreshDatatables(data);
});

/**
 * Button to clear filters and refresh table eith all rows
 */
$('.clear-filter').on('click', function(e)
{
	refreshDatatables('null');

	$('.row.line:not(:first)').remove();
	$('.row.line :input:not([data-name=plus])').val('').trigger('change');
});


/**
 * Load operator supported by column selected
 * @param column
 */
function loadFilterOperators(column)
{
	//Define vars
	var type = column.children('option:selected').attr('data-type');
	var values = column.children('option:selected').attr('data-values');

	var line = column.parents('.row.line');

	var operator = line.find('[name^=operator]');
	var operatorChilds = operator.children('option');

	var valueInput = line.find('input[name^=value]');
	var valueSelect = line.find('select[name^=value]');

	// //Remove select2
	// if(valueSelect.length > 0)
	// 	$('.fix-select').find('*').not('input[name^=value]').remove();
	//
	// //Reset input
	// valueInput.removeAttr('disabled')
	// 	.removeClass('number data date')
	// 	.prop('type', 'text')
	// 	.unmask()
	// 	.empty()
	// 	.show();
	//
	// operator.val('').trigger('change');
	//
	switch(type)
	{
		case 'number':
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_LESS_THAN,
					FILTER_GREATER_THAN,
					FILTER_LESS_OR_EQUAL,
					FILTER_GREATER_OR_EQUAL,
					FILTER_EQUAL
				];

				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});

			valueInput.addClass('number');
			break;

		case 'select':
			let selectVals = $('<select/>').attr({'name' : 'value[]', 'data-name' : 'value'});
			let valuesText = JSON.parse(values);
			let objValues = [];

			//Disable operators
			operatorChilds.each(function()
			{
				let value = $(this).val();
				if(value !== FILTER_EQUAL)
					$(this).attr('disabled', true);
				else
					$(this).removeAttr('disabled').prop('selected', true);
			});

			//Generate data to select2
			for(let i = 0; i < valuesText.length; i++)
				objValues.push({'id' : valuesText[i].value, 'text' : valuesText[i].label});

			selectVals.select2({data: objValues});
			valueInput.before(selectVals).attr('disabled', true).hide();
			break;

		case 'date':
		case 'datetime':
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_DATE_GREATER_THAN,
					FILTER_DATE_LESS_THAN,
					FILTER_EQUAL
				];
				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});

			valueInput.prop('type', 'date');
			break;

		default:
			operatorChilds.each(function(){
				let value = $(this).val();
				let correctValues = [
					FILTER_EQUAL,
					FILTER_CONTAINS,
					FILTER_NOT_EQUAL,
					FILTER_START_WITH,
					FILTER_END_WITH
				];

				if(in_array(value, correctValues))
					$(this).removeAttr('disabled');
				else
					$(this).attr('disabled', true);
			});
	}
	//
	// //Fix masks an select2
	prettySelect('select');
	loadMasks();
}

/**
 * Get columns of table to set on datatables
 * @param table
 * @returns {Array}
 */
function getColumns(table)
{
	var columns = table.find('thead > tr > th');
	var objColumns = [];

	//Define columns
	columns.each(function(index, value)
	{
		var column = {
			'data': $(this).data('slug'),
			'name': $(this).data('slug')
		};

		objColumns.push(column);
	});

	return objColumns;
}

/**
 * Each all filters configured an send the query to controller
 * @returns {Array}
 */
function getFilters()
{
	var data = [];

	$.each($('.row.line'), function()
	{
		var line = $(this);
		data.push({
			'column' : line.find('[data-name=column]:not(:disabled)').val(),
			'operator' : line.find('[data-name=operator]:not(:disabled)').val(),
			'value' : line.find('[data-name=value]:not(:disabled)').val(),
			'plus' : line.find('[data-name=plus]:not(:disabled)').val()
		});
	});

	return data;
}

/**
 * Send request to controller make the filter and refresh datatables with new rows
 * @param table
 * @param data
 */
function refreshDatatables(data)
{
	var url = form.attr('action');
	var table = $('[data-type="datatables"]:first');

	table.dataTable({
		paging: true,
		destroy: true,
		DeferRender: true,
		serverSide: false,
		processing: true,
		columns: getColumns(table),
		columnDefs: [{
			targets: 'no-sort',
			orderable: false
		}],
		language: {
			"url": dev.baseUrl + "/plugins/dataTables/Languages/portugues-brasil.lang"
		},
		ajax: {
			url: url,
			type: "GET",
			data: data
		},
		fnDrawCallback: function(){
			// prettySelect('select');
			fixeActions();
		}
	});
}