<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            'fullName',
            ['attribute' => 'is_admin',  'value' => function ($model) {return $model->is_admin  ? 'Yes' : 'No';}],
            ['attribute' => 'is_waiter', 'value' => function ($model) {return $model->is_waiter ? 'Yes' : 'No';}],
            ['attribute' => 'is_cook',   'value' => function ($model) {return $model->is_cook   ? 'Yes' : 'No';}],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
