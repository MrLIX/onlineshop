<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OurService */

$this->title = 'Our Services Page';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Our Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="150px">';
                },
                'format' => 'raw',

            ],
            'title_ru',
            'title_en',
          //  'path',
            'content_ru:ntext',
            'content_en:ntext',
        ],
    ]) ?>

</div>
