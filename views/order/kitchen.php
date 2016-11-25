<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-kitchen">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'title',
            'condition',
            [
                'format' => 'raw',
                'attribute' => 'estimated_time',
                'value' => function ($model) {
                    if ($model->condition == 'pending')
                        return \russ666\widgets\Countdown::widget([
                            'datetime' => date('Y-m-d H:i:s', strtotime($model->estimated_time)),
                            'events' => [
                                'finish' => 'function(){location.reload()}',
                            ],
                        ]);
                    elseif ($model->condition == 'ready') return '';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '30'],
                'template' => '{update}',
            ],
        ],
        'rowOptions' => function($model) {
            if ($model->condition == 'new')   return ['class' => 'danger'];
            if ($model->condition == 'ready') return ['class' => 'success'];
        },
    ]); ?>

</div>
