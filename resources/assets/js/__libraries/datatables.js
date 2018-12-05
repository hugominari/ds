/**
 * Event that will scroll through all tables and popular with datatables
 * @event Jquery#Each
 */
$("table[data-type='datatables']").each(function(e)
{
	var table = $(this);
	var defaultSort = 1;
	var thSort = $('th.default-sort');
	
	//Default sort
	if(thSort.length > 0)
		defaultSort = parseInt(thSort.index());
	
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
			"url": dev.baseUrl + "/plugins/dataTables/Languages/portugues-brasil.lang"
		},
		preDrawCallback: function(settings)
		{
			prettySelect('select');
			$(".dataTables_length > label").css({'width' : '70px'});
			$('.dataTables_filter input[type="search"]').attr('placeholder', 'Filtro rápido...');
		},
		initComplete: function(settings, json)
		{
			fixeActions();
		}
	});
});