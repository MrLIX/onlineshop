<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rayon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rayon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','region')) ?>

    <?= $form->field($model, 'rayon')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
