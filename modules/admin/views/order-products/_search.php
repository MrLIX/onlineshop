<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\OrderProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orders_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'product_price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
