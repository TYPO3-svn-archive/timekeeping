/**
 * User: alex
 * Date: 22.11.11
 * Time: 18:44
 */

(function($) {
	$(function() {
		$('.datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
		oTable = $('.datatables').dataTable({
			"bJQueryUI": true,
			"oLanguage": {
				"sLengthMenu": "Zeige _MENU_ Datensätze pro Seite",
				"sZeroRecords": "Leider nichts gefunden.",
				"sInfo": "Zeige _START_ bis _END_ von _TOTAL_ Datensätzen",
				"sInfoEmpty": "Zeige 0 bis 0 von 0 Datensätzen",
				"sInfoFiltered": "(ungefiltert _MAX_)"
			}
        }).show();
		var nNodes = oTable.fnGetNodes( );
		$('form[name=family]').submit(function(){
			$('.dataTables_wrapper').replaceWith('<table class="datatables"></table>');
			$('.datatables').append(nNodes);
		});
	});
})(jQuery);
