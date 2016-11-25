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
        // \russ666\widgets\Countdown::className(), [
        // 'datetime' => date('Y-m-d H:i:s', time() + 1000),
        // 'format' => '%M:%S',
        // 'events' => [
        //     'finish' => 'function(){location.reload()}',
        //     ]
        // ]
        \janisto\timepicker\TimePicker::className(), [
        //'language' => 'fi',
        'mode' => 'datetime',
        'clientOptions'=>[
            'dateFormat' => 'yy-mm-dd',
            'timeFormat' => 'HH:mm:ss',
            'showSecond' => true,
            ]
        ]
    ) ?>
    <?= \russ666\widgets\Countdown::widget([
    'datetime' => date('Y-m-d H:i:s', strtotime('+15 min')),
    // 'format' => '%M:%S',
    'events' => [
        'finish' => 'function(){location.reload()}',
    ],
    ])
    ?>

    <?= (date('Y-m-d H:i:s', strtotime('+15 min')));
    ?>

    <?php // $form->field($model, 'authors')->dropDownList(ArrayHelper::map(Author::find()->all(), 'id', 'first_name', 'second_name')) ?>

    <?= $form->field($model, 'condition')->dropDownList([ 'new' => 'New', 'pending' => 'Pending', 'ready' => 'Ready', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
