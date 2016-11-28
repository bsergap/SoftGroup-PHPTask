<?php

use yii\web\View;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Saloon', 'url' => ['saloon']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("var user_id = '".$user_id."';", View::POS_END, 'my-options');
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>
</div>
