<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = ['label' => 'Kitchen', 'url' => ['kitchen']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-kitchen">

    <h1><?= Html::encode($this->title) ?></h1>

    <table id="kitchen" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Table number</th>
                <th>Title</th>
                <th>Estimated time</th>
                <th>Waiter</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
    var user_id = '<?= $user_id ?>';
    // (function($) {
    //     $(document).ready(function() {
    //         ws = new WebSocket("ws://localhost:8888");
    //         ws.onopen = function () {
    //             console.log("Opening a connection...");
    //             $('#kitchen').DataTable({
    //                 "bProcessing": true,
    //                 "bServerSide": true,

    //                 "info": false,
    //                 "ordering": false,
    //                 "paging": false,
    //                 "searching": false,

    //                 "fnServerData": function (sSource, aoData, fnCallback, oSettings) {
    //                   ws.onmessage = function (e) {fnCallback(JSON.parse(e.data));};
    //                   ws.send(JSON.stringify(aoData));
    //                   console.log('Send Ok!');
    //                 }
    //               });
    //         };
    //         ws.onclose = function (e) {console.log(e, "I'm sorry. Bye!");};
    //         ws.onerror = function (e) {console.log("ERR: " + e.data);};
    //         // ws.onmessage = function (e) {console.log(evt.data);};
    //     });
    // })(jQuery);
    </script>
</div>
