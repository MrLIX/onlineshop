<?php

use app\models\Category;
use app\models\Colors;
use app\models\Types;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use trntv\filekit\widget\Upload;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'file')->widget(
                Upload::className(),
                [
                    'url' => ['/admin/file-storage/upload'],
                    'sortable' => true,
                    'maxFileSize' => 10 * 1024 * 1024, // 10 MiB

                ]);
            ?>
        </div>
        <div class="col-md-9">

            <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

        </div>

    </div>


    <?php echo $form->field($model, 'attachments')->widget(
        Upload::className(),
        [
            'url' => ['/admin/file-storage/upload'],
            'sortable' => true,

            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 16
        ]);
    ?>


    <?= $form->field($model, 'price')->textInput() ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-products-discount">
                <label class="control-label" for="products-discount">Discount</label>
                <div class="input-group">
                    <div class="input-group-addon" style="color:#333; padding-right:20px">%</div>

                    <input type="text" id="products-discount" onkeyup="discount()" class="form-control" name="Products[discount]" value="<?= $model->isNewRecord ? '' : $model->discount ?>" aria-invalid="false">

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'discount_price')->textInput() ?>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->all(),'id','title_ru'),['prompt' =>'Choose category']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList([],['prompt' =>'Choose sub-category'])->label('Sub Category'); ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'colors')->widget(MultipleInput::className(), [
                'columns' => [
                    [
                        'name' => 'id_color',
                        'type' => 'dropDownList',
                        'items' => ArrayHelper::map(Colors::find()->where(['status' => 1])->all(), 'id', 'name_ru'),
                        'options' => [
                            'prompt' => 'Choose color'
                        ]

                    ],

                ],
                'addButtonOptions' => ['class' => 'btn btn-success']
            ])->label('Colors') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'types')->widget(MultipleInput::className(), [
                'columns' => [
                    [
                        'name' => 'id_type',
                        'type' => 'dropDownList',
                        'items' => ArrayHelper::map(Types::find()->where(['status' => 1])->all(), 'id', 'name_ru'),
                        'options' => [
                            'prompt' => 'Choose type'
                        ]

                    ],

                ],
                'addButtonOptions' => ['class' => 'btn btn-success']
            ])->label('Types') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'buy_counts')->widget(MultipleInput::className(), [
                'columns' => [
                    [
                        'name' => 'id_count',
                        'type' => 'textInput',
                        'options' => [
                                'placeholder' => 'Enter count'
                        ]

                    ],

                ],
                'addButtonOptions' => ['class' => 'btn btn-success']
            ])->label('Buy Count') ?>
        </div>
    </div>


    <?= $form->field($model, 'content_ru')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 300 ]),
    ]); ?>

    <?= $form->field($model, 'content_en')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 300 ]),
    ]); ?>



    <?= $form->field($model, 'status')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
