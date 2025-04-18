$(document).ready(function () {
    $('table.table-card').each(function(){
        // Get table card
        table = $(this);
        var thArray = [];
        // Get all headers
        table.find('thead > tr > th').each(function(){
            thArray.push($(this).text());
        });
        // Add headers to attribute data-card-title of td
        table.find('tbody > tr').each(function(){
            row = $(this);
            for(i = 0; i < thArray.length; i++) {
                row.children('td').eq(i).attr('data-card-title', thArray[i]);
            }
        });
    });
});