<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = ['label' => 'Saloon', 'url' => ['saloon']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-saloon">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="conteiner text-center">
        <p><?= Html::a('Place an order', ['make-order'], ['class' => 'btn btn-lg btn-success', 'target' => 'blank']) ?></p>
    </div>

    <table id="saloon" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Condition</th>
                <th>Estimated time</th>
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
    //             $('#saloon').DataTable({
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
