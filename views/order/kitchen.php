<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = ['label' => 'Kitchen', 'url' => ['kitchen']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("var user_id = '".$user_id."';", View::POS_END, 'my-options');
?>
<div class="site-kitchen">

    <h1><?= Html::encode($this->title) ?></h1>

    <table id="kitchen" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Table number</th>
                <th>Title</th>
                <th>Condition</th>
                <th>Estimated time</th>
                <th>Waiter</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
    <?php Modal::begin(['header' => '<h2>Edit Order</h2>',]); ?>
        <?= Html::beginForm(['order/update'], 'post', ['id' => 'modal-kitchen', 'enctype' => 'multipart/form-data']) ?>

        <?= \janisto\timepicker\TimePicker::widget([
                'mode' => 'datetime',
                'clientOptions'=>[
                    'dateFormat' => 'yy-mm-dd',
                    // 'timeFormat' => 'HH:mm',
                    // 'showSecond' => true,
                ],
            ]
        ) ?>

        <?= Html::dropDownList('condition', null, [ 'new' => 'New', 'pending' => 'Pending', 'ready' => 'Ready'], ['class' => 'form-control']) ?>
        <?= Html::input('hidden', 'order_id') ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'data-target' => "#w0", 'data-toggle' => "modal"]) ?>
        </div>
        <?= Html::endForm() ?>
    <?php Modal::end(); ?>
</div>
