<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ColorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Colors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Colors'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name_ru',
            'name_en',
            [
                    'attribute' => 'color',
                    'value' => function($model){
                        return '<span style="width: 60px; height: 30px; color:#000; background-color: '.$model->color.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$model->color;
                    },
                    'format' => 'html',
            ],
            [
                   'attribute' => 'status',
                   'value' => function($model)
                        {
                            return $model->status == 1 ? '<p style="color:#0b58a2">Published</p>' : '<p style="color:#f00">Not published</p>';
                        },
                   'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
