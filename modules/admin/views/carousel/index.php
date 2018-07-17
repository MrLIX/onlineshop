<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarouselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Carousels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Carousel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                    'attribute' => 'path',
                    'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="150px">';
                    },
                    'format' => 'raw',

            ],

            'title_ru',
            //'title_uz',
            'content_ru:ntext',
            //'content_uz:ntext',
            'order',
            'created_at:date',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
