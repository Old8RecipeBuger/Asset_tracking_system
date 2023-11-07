$(document).ready(function() {
    // Setup - add a text input to each footer cell
    //$('#datatable thead tr').clone(true).addClass('filters').appendTo('#datatable thead');
    
    
    var originalHeader = $('#datatable thead tr:first');
    var clonedHeader = originalHeader.clone(true).addClass('filters').appendTo('#datatable thead');

    clonedHeader.height(originalHeader.height());
    clonedHeader.width(originalHeader.width());
    

    var table = $('#datatable').DataTable( {
        "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "iDisplayLength": 50,
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [
            { width: '100px', targets: '_all' }
        ],
        initComplete: function() {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function(colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html( '<input type="text" style="width:80%" placeholder="'+title+'" />' );
                // On every keypress in this input
                $('input', $('.filters th').eq($(api.column(colIdx).header()).index()) )
                    .off('keyup change')
                    .on('keyup change', function (e) {
                        e.stopPropagation();
                        // Get the search value
                        $(this).attr('title', $(this).val());
                        var regexr = '({search})';
                        var cursorPosition = this.selectionStart;
                        // Search the column for that value
                        api
                            .column(colIdx)
                            .search((this.value != "") ? regexr.replace('{search}', '((('+this.value+')))') : "", this.value != "", this.value == "")
                            .draw();
                        $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                    });
            });
        }
    } );
} );