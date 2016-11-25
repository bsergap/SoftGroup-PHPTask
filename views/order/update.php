<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Order: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['kitchen']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
