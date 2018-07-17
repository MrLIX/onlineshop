<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\About */

$this->title = $model->title_ru;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Abouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="150px">';
                },
                'format' => 'raw',

            ],
            'title_ru',
            'title_en',
            'content_ru:ntext',
            'content_en:ntext',
            'param1_title_ru',
            'param1_title_en',
            'param1_content_ru:ntext',
            'param1_content_en:ntext',
            'param2_title_ru',
            'param2_title_en',
            'param2_content_ru:ntext',
            'param2_content_en:ntext',
            'param3_title_ru',
            'param3_title_en',
            'param3_content_en:ntext',
            'param3_content_ru:ntext',
        ],
    ]) ?>

</div>
