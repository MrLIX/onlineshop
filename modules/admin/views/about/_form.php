<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\About */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'path')->fileInput(['class' => 'dropify', 'data-default-file' => '/uploads/' . $model->path]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_ru')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 300 ]),
    ]); ?>

    <?= $form->field($model, 'content_en')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 300 ]),
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'param1_title_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param1_title_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param1_content_ru')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'param1_content_en')->textarea(['rows' => 4]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'param2_title_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param2_title_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param2_content_ru')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'param2_content_en')->textarea(['rows' => 4]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'param3_title_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param3_title_en')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'param3_content_en')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'param3_content_ru')->textarea(['rows' => 4]) ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
