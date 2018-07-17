<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Socials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="socials-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'path')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'order')->dropDownList([
            '1' =>  '1',
            '2' =>  '2',
            '3' =>  '3',
            '4' =>  '4',
            '5' =>  '5',
            '6' =>  '6',
            '7' =>  '7',
            '8' =>  '8',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
