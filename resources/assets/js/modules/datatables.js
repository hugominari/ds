/**
 * Event that will scroll through all tables and popular with datatables
 * @event Jquery#Each
 */
try
{
	$("table[data-type='datatables']").each(function(e)
	{
		var table = $(this);
		var defaultSort = 1;
		var thSort = $('th.default-sort');
		
		//Default sort
		if(thSort.length > 0)
			defaultSort = parseInt(thSort.index());
		
		console.log(getColumns(table));
		
		table.dataTable({
			columns: getColumns(table),
			ajax: table.attr('data-source'),
			paging: true,
			responsive: true,
			serverSide: true,
			processing: false,
			DeferRender: true,
			columnDefs: [
				{
					targets: 'no-sort',
					orderable: false,
				},
				{
					searchable    : false,
					targets     : 'no-filter'
				}
			],
			order: [[defaultSort, 'asc']],
			language: {
				"url": dev.baseUrl + "/plugins/datatables/Languages/portugues-brasil.lang"
			},
			preDrawCallback: function(settings)
			{
				var tableId = '#' + $(this).attr('id');
				var tableObj = $(tableId);
				
				tableObj.DataTable();
				$(tableId + '_wrapper').find('label').each(function () {
					$(this).parent().append($(this).children());
				});
				$(tableId + '_wrapper .dataTables_filter').find('input').each(function () {
					$(this).find('input').attr("placeholder", "Filtro rápido");
					$(this).find('input').removeClass('form-control-sm');
				});
				$(tableId + '_wrapper .dataTables_length').addClass('d-none');
				$(tableId + '_wrapper .dataTables_filter').addClass('md-form');
				$(tableId + '_wrapper .dataTables_filter').find('label').remove();
			},
			initComplete: function(settings, json)
			{
				fixeActions();
			}
		});
	});
}catch (e)
{
	console.log('');
}