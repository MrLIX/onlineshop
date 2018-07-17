<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\AboutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title_ru') ?>

    <?= $form->field($model, 'title_en') ?>

    <?= $form->field($model, 'content_ru') ?>

    <?= $form->field($model, 'content_en') ?>

    <?php // echo $form->field($model, 'param1_title_ru') ?>

    <?php // echo $form->field($model, 'param1_title_en') ?>

    <?php // echo $form->field($model, 'param1_content_ru') ?>

    <?php // echo $form->field($model, 'param1_content_en') ?>

    <?php // echo $form->field($model, 'param2_title_ru') ?>

    <?php // echo $form->field($model, 'param2_title_en') ?>

    <?php // echo $form->field($model, 'param2_content_ru') ?>

    <?php // echo $form->field($model, 'param2_content_en') ?>

    <?php // echo $form->field($model, 'param3_title_ru') ?>

    <?php // echo $form->field($model, 'param3_title_en') ?>

    <?php // echo $form->field($model, 'param3_content_en') ?>

    <?php // echo $form->field($model, 'param3_content_ru') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
