<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'fullName',
            ['format' => 'raw', 'attribute' => 'is_admin',  'value' => $model->is_admin  ? 'Yes' : 'No'],
            ['format' => 'raw', 'attribute' => 'is_waiter', 'value' => $model->is_waiter ? 'Yes' : 'No'],
            ['format' => 'raw', 'attribute' => 'is_cook',   'value' => $model->is_cook   ? 'Yes' : 'No'],
        ],
    ]) ?>

</div>
