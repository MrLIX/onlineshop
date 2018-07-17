<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Abouts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create About'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="150px">';
                },
                'format' => 'raw',

            ],
            'title_ru',
            //'title_en',
            'content_ru:ntext',
            //'content_en:ntext',
            //'param1_title_ru',
            //'param1_title_en',
            //'param1_content_ru:ntext',

            //'param2_title_ru',
            //'param2_title_en',
            //'param2_content_ru:ntext',
            //'param2_content_en:ntext',
            //'param3_title_ru',
            //'param3_title_en',
            //'param3_content_en:ntext',
            //'param3_content_ru:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
