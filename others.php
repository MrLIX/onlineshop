<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 18.06.2018
 * Time: 10:01
 */

public function behaviors()
{
    return [

        [
            'class' => '\app\components\FileUploadBehaviour'
        ],
    ];
}

[['path',], 'file'],


<?= $form->field($model, 'path')->fileInput(['class' => 'dropify', 'data-default-file' => '/uploads/' . $model->path]) ?>

[
'attribute' => 'path',
'value' => function($model){
return '<img src="/uploads/'.$model->path.'" width="150px">';
},
'format' => 'raw',

],

 <?= $form->field($model, 'order')->dropDownList([
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
    '6' => '6',
    '7' => '7',
    '8' => '8',
    '9' => '9',
]) ?>
<?php
[
'attribute' => 'status',
'value' => function($model)
{
return $model->status == 1 ? '<p style="color:#0b58a2">Published</p>' : '<p style="color:#f00">Not published</p>';
},
'format' => 'html',
],

public function getTitle(){

    if (Yii::$app->language == 'ru'):  return $this->title_ru;

    endif;
    if (Yii::$app->language == 'en'):  return $this->title_en;

endif;
}

public function getContent(){

    if (Yii::$app->language == 'ru'):  return $this->content_ru;

    endif;
    if (Yii::$app->language == 'en'):  return $this->content_en;

    endif;
}
?>


