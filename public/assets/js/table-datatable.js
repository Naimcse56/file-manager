$(function() {
	"use strict";

    $(document).ready(function() {
        $('#data-table').DataTable();
    });


    $(document).ready(function() {
    var table = $('#data-table-export').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print']
    } );
    
    table.buttons().container()
        .appendTo( '#data-table-export_wrapper .col-md-6:eq(0)' );
    });


});