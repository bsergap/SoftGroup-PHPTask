<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'table_number')->textInput() ?>

    <?= $form->field($model, 'estimated_time')->textInput()->widget(
        \janisto\timepicker\TimePicker::className(), [
            'mode' => 'datetime',
            'clientOptions'=>[
                'dateFormat' => 'yy-mm-dd',
                // 'timeFormat' => 'HH:mm',
                // 'showSecond' => true,
            ],
        ]
    ) ?>

    <?= $form->field($model, 'condition')->dropDownList([ 'new' => 'New', 'pending' => 'Pending', 'ready' => 'Ready', ]) ?>

    <?= $form->field($model->owner, 'fullName')->textInput(['readonly' => true])->label('Waiter') ?>

    <?= $form->field($model, 'created')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
