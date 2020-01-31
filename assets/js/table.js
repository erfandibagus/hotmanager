$(document).ready(function () {
    $('#dataTable').dataTable({
        "language": {
            "info": "Total _TOTAL_ entries",
            "infoEmpty": "Total 0 entries",
            "lengthMenu": "Show _MENU_ entries"
        },
        "order": [
            [0, 'desc']
        ]
    });
});