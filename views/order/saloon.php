<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = ['label' => 'Saloon', 'url' => ['saloon']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("var user_id = '".$user_id."';", View::POS_END, 'my-options');
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
</div>
