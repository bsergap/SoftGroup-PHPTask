var ws;
(function($) {
    function renderCountdown(data, type, full, meta) {
        if(data) return '<span id="id-'+full[0]+'"></span><script>$("#id-'+full[0]+'").countdown("'+
            data+'", function(event) {$(this).text(event.strftime("%H:%M:%S"));});</script>';
        else return '';

    }
    $(document).ready(function() {
        ws = new WebSocket("ws://localhost:8888");
        ws.onopen = function () {
            console.log("Opening a connection...");

            var $dt;
            if($('#saloon').length) $dt = $('#saloon');
            if($('#kitchen').length) $dt = $('#kitchen');

            if($dt) $dt.DataTable({
                "bProcessing": true,
                "bServerSide": true,

                "info": false,
                "ordering": false,
                "paging": false,
                "searching": false,

                "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
                    ws.onmessage = function (e) {
                        var data = JSON.parse(e.data);
                        if(!data['task'] || data['task'] !== 'reload')
                            fnCallback(data);
                        else {
                            ws.send(JSON.stringify({'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData}));
                            console.log('Reload Ok!', {'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData});
                        }
                    };
                    ws.send(JSON.stringify({'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData}));
                    console.log('Send Ok!', {'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData});
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false
                    },
                    {
                        "targets": 3,
                        "render": renderCountdown
                    },
                    {
                        "targets": 5,
                        "render": function (data, type, full, meta) {return '<a href="'+data+'">Edit</a>';}
                    }
                ]
            });

            if($('.make-order-form form').length) {
                $('.make-order-form form').submit(function (e) {
                    var $this = $(this);
                    setTimeout(function (e) {
                        // ws.send(JSON.stringify({'action': 'reload', 'user_id': user_id}));
                        $this.find('button[type="submit"]').prop('disabled', false);
                        console.log('Submit2 Ok!');
                    }, 1000);
                    $this.find('button[type="submit"]').prop('disabled', true);
                    ws.send(JSON.stringify({'action': 'make-order', 'user_id': user_id, 'data': {
                        'title': $('#order-title').val(),
                        'table_number': $('#order-table_number').val()
                    }}));
                    console.log('Submit Ok!');
                    return false;
                });
            }
        };
        ws.onclose = function (e) {console.log(e, "I'm sorry. Bye!");};
        ws.onerror = function (e) {console.log("ERR: " + e.data);};
        ws.onmessage = function (e) {console.log(e.data);};
    });
})(jQuery);

// var editor; // use a global for the submit and return data rendering in the examples
 
// $(document).ready(function() {
//     editor = new $.fn.dataTable.Editor( {
//         ajax: "../php/staff.php",
//         table: "#example",
//         fields: [ {
//                 label: "First name:",
//                 name: "first_name"
//             }, {
//                 label: "Last name:",
//                 name: "last_name"
//             }, {
//                 label: "Position:",
//                 name: "position"
//             }, {
//                 label: "Office:",
//                 name: "office"
//             }, {
//                 label: "Extension:",
//                 name: "extn"
//             }, {
//                 label: "Start date:",
//                 name: "start_date",
//                 type: "datetime"
//             }, {
//                 label: "Salary:",
//                 name: "salary"
//             }
//         ]
//     } );
 
//     // Activate an inline edit on click of a table cell
//     $('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
//         editor.inline( this );
//     } );
 
//     $('#example').DataTable( {
//         dom: "Bfrtip",
//         ajax: "../php/staff.php",
//         columns: [
//             {
//                 data: null,
//                 defaultContent: '',
//                 className: 'select-checkbox',
//                 orderable: false
//             },
//             { data: "first_name" },
//             { data: "last_name" },
//             { data: "position" },
//             { data: "office" },
//             { data: "start_date" },
//             { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
//         ],
//         select: {
//             style:    'os',
//             selector: 'td:first-child'
//         },
//         buttons: [
//             { extend: "create", editor: editor },
//             { extend: "edit",   editor: editor },
//             { extend: "remove", editor: editor }
//         ]
//     } );
// } );