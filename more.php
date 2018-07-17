<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 02.06.2018
 * Time: 15:00
 */

use trntv\filekit\behaviors\UploadBehavior;
use yii\helpers\Html;

?>

<?= Html::img(Yii::getAlias('@web') . '/uploads/' . $item->img) ?>

<div class="paginator">
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'options' => ['class' => false],
        'prevPageLabel' => false,
        'nextPageLabel' => false,
        'activePageCssClass' => 'activeItem',

    ]);?>
</div>

<?php

public $image;

/**
* @inheritdoc
*/

public function behaviors()
{
    return [

    [
        'class' => UploadBehavior::className(),
        'attribute' => 'image',
        'pathAttribute' => 'path',
        'baseUrlAttribute' => 'base_url',
        'typeAttribute' => 'type'
        ],
    ];
}
?>

    /////////////////////////////////////
    ?>
<?php echo $form->field($model, 'image')->widget(
    \trntv\filekit\widget\Upload::className(),
    ['url' => ['/file-storage/upload'],]
) ?>

<?php

////////////////////////////


['attribute' => 'path',
    'format' => 'html',
    'value' => function ($model) {
        return Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
            'path' => $model->path], true), ['style' => 'max-width: 200px']);
    }],

/////////////////////////////////

['attribute' => 'status',
    'value' => function($model)
    {
        return $model->status == 1 ? '<p style="color:#0b58a2">Published</p>' : '<p style="color:#f00">Not published</p>';
    },
    'format' => 'html',],


////////////////////////////////
?>

<?php echo $form->field($model, 'content_en')->widget(
\yii\imperavi\Widget::className(),
['plugins' => ['fullscreen', 'fontcolor', 'video'],
'options' => ['minHeight' => 200,
'maxHeight' => 200,
'buttonSource' => true,
'convertDivs' => false,
'removeEmptyTags' => true,]]
) ?>
<?php echo $form->field($model, 'content_ru')->widget(
\yii\imperavi\Widget::className(),
['plugins' => ['fullscreen', 'fontcolor', 'video'],
'options' => ['minHeight' => 200,
'maxHeight' => 200,
'buttonSource' => true,
'convertDivs' => false,
'removeEmptyTags' => true,]]
) ?>
<?php echo $form->field($model, 'content_uz')->widget(
\yii\imperavi\Widget::className(),
['plugins' => ['fullscreen', 'fontcolor', 'video'],
'options' => ['minHeight' => 200,
'maxHeight' => 200,
'buttonSource' => true,
'convertDivs' => false,
'removeEmptyTags' => true,]]
) ?>

    ////////////////////////////////

<?php
['attribute' => 'path',
'value' => function($model){
return '<a href="'.$model->base_url.'/'.$model->path.'" download="" >Download resume</a>';
},
'format' => 'html',],

/////////////////////////////////
?>
<?php

public function getTitle(){

if (Yii::$app->language == 'en'):  return $this->title_en;

endif;
if (Yii::$app->language == 'ru'):  return $this->title_ru;

endif;
if (Yii::$app->language == 'uz'):  return $this->title_uz;

endif;
}

public function getContent(){

if (Yii::$app->language == 'en'):  return $this->content_en;

endif;
if (Yii::$app->language == 'ru'):  return $this->content_ru;

endif;
if (Yii::$app->language == 'uz'):  return $this->content_uz;

endif;
}
?>

    /////////////////////////////////////////
<?= Html::img(Yii::$app->glide->createSignedUrl(['glide/index',
'path' => $item->path], true), ['alt' => $item->title])
?>
