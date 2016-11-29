var WSocket;
(function($) {
    function renderCountdown(data, type, full, meta) {
        if(data) return '<span id="id-'+full[0]+'"></span><script>$("#id-'+full[0]+
            '").countdown("'+data+'", function(event) {'+
                'if(event.type == "stoped" && $(this).text() == "00:00:01")'+
                    'WSocket.send(JSON.stringify({"action":"reload"}));'+
                '$(this).text(event.strftime("%H:%M:%S"));'+
            '});</script>';
        else return '';

    }
    $(document).ready(function() {
        var wsurl = "ws://locahost:8080";
        WSocket = new WebSocket(wsurl);
        WSocket.onopen = function () {
            console.log("Opening a connection...");

            var $dt, colDefs;
            if($('#saloon').length) {
                $dt = $('#saloon');
                colDefs = [
                    {
                        "targets": 0,
                        "visible": false
                    },
                    {
                        "targets": 3,
                        "render": renderCountdown
                    }
                ];
            }
            if($('#kitchen').length) {
                $dt = $('#kitchen');
                colDefs = [
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
                        "render": function (data, type, full, meta) {
                            return '<a href="#" data-toggle="modal" data-target="#w0" onclick="$(\'#modal-kitchen input[name=order_id]\').val(\''+full[0]+'\')">Edit</a>';
                        }
                    }
                ];
                $('#modal-kitchen').submit(function (e) {
                    var $this = $(this);
                    setTimeout(function (e) {
                        // WSocket.send(JSON.stringify({'action': 'reload', 'user_id': user_id}));
                        $this.find('button[type="submit"]').prop('disabled', false);
                        console.log('Submit2 Ok!');
                    }, 1000);
                    $this.find('button[type="submit"]').prop('disabled', true);
                    WSocket.send(JSON.stringify({'action': 'edit-order', 'user_id': user_id, 'data': {
                        'order_id': $('#modal-kitchen input[name=order_id]').val(),
                        'estimated_time': $('#modal-kitchen input.hasDatepicker').val(),
                        'condition': $('#modal-kitchen select[name=condition]').val()
                    }}));
                    console.log('Submit Ok!');
                    return false;
                });
            }

            if($dt) $dt.DataTable({
                "bProcessing": true,
                "bServerSide": true,

                "info": false,
                "ordering": false,
                "paging": false,
                "searching": false,

                "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
                    WSocket.onmessage = function (e) {
                        var data = JSON.parse(e.data);
                        if(!data['task'] || data['task'] !== 'reload')
                            fnCallback(data);
                        else {
                            WSocket.send(JSON.stringify({'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData}));
                            console.log('Reload Ok!', {'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData});
                        }
                    };
                    WSocket.send(JSON.stringify({'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData}));
                    console.log('Send Ok!', {'action': oSettings.sInstance, 'user_id': user_id, 'data': aoData});
                },
                "columnDefs": colDefs
            });

            if($('.make-order-form form').length) {
                $('.make-order-form form').submit(function (e) {
                    var $this = $(this);
                    setTimeout(function (e) {
                        // WSocket.send(JSON.stringify({'action': 'reload', 'user_id': user_id}));
                        $this.find('button[type="submit"]').prop('disabled', false);
                        console.log('Submit2 Ok!');
                    }, 1000);
                    $this.find('button[type="submit"]').prop('disabled', true);
                    WSocket.send(JSON.stringify({'action': 'make-order', 'user_id': user_id, 'data': {
                        'title': $('#order-title').val(),
                        'table_number': $('#order-table_number').val()
                    }}));
                    console.log('Submit Ok!');
                    return false;
                });
            }
        };
        WSocket.onclose = function (e) {
            console.log(e, "I'm sorry. Bye!");
            setTimeout(function(){
                var ws = new WebSocket(wsurl);
                ws.onopen = function () {
                    console.log("Reopening a connection...");};
                ws.onclose = WSocket.onclose;
                ws.onerror = WSocket.onerror;
                ws.onmessage = WSocket.onmessage;
                WSocket = ws;
            }, 5000);
        };
        WSocket.onerror = function (e) {console.log("ERR: " + e.data);};
        WSocket.onmessage = function (e) {console.log(e.data);};
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