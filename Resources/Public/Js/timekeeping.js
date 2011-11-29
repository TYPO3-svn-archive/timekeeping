/**
 * User: alex
 * Date: 22.11.11
 * Time: 18:44
 */

(function($) {
	$(function() {
		$('#dialog').dialog({
			bgiframe: true,
			autoOpen: false,
			modal: true,
			width: 350,
			height: 150
		});

		$('#timekeeping-menu a.delete').click(function(e) {
			e.preventDefault();
			var targetUrl = $(this).attr('href');
			$('#dialog').dialog({
				buttons : {
					'Abbrechen' : function() {
						$(this).dialog('close');
					},
					'Familie löschen' : function() {
						window.location.href = targetUrl;
					}
				},
				title: 'Familie löschen'
			});
			$('#dialog').html('Sind Sie sicher, dass Sie diese Familie löschen wollen?').dialog('open');
		});

		$('a.confirm').click(function(e) {
			e.preventDefault();
			var targetUrl = $(this).attr('href');
			$('#dialog').dialog({
				buttons : {
					'Abbrechen' : function() {
						$(this).dialog('close');
					},
					'Eintrag löschen' : function() {
						window.location.href = targetUrl;
					}
				},
				title: 'Eintrag löschen'
			});
			$('#dialog').html('Sind Sie sicher, dass Sie diesen Eintrag löschen wollen?').dialog('open');
		});

		$('.datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
		oTable = $('.datatables').dataTable({
			"bJQueryUI": true,
			"oLanguage": {
				"sLengthMenu": "Zeige _MENU_ Datensätze pro Seite",
				"sZeroRecords": "Leider nichts gefunden.",
				"sInfo": "Zeige _START_ bis _END_ von _TOTAL_ Datensätzen",
				"sInfoEmpty": "Zeige 0 bis 0 von 0 Datensätzen",
				"sInfoFiltered": "(ungefiltert _MAX_)",
				"sSearch": "Suche"
			}
        }).show();
		var nNodes = oTable.fnGetNodes( );
		$('form[name=family]').submit(function(){
			$('.dataTables_wrapper').replaceWith('<table class="datatables"></table>');
			$('.datatables').append(nNodes);
		});
	});
})(jQuery);
