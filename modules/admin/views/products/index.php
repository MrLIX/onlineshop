<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="100px">';
                },
                'format' => 'raw',

            ],
            [
                    'attribute' => 'category_id',
                    'value' => function ($model){
                        return $model->subCategory->title_ru;
                    },
                    'format' => 'html',
            ],
            //'base_url:url',
            'title_ru',
            'title_en',
            //'content_ru:ntext',
            //'content_en:ntext',
            [
                    'attribute' => 'price',
                    'value' => function($model) {
                       return number_format($model->price, '0', '.', ' ');
                    },
                    'format' => 'html'
            ],
            'discount',
            [
                'attribute' => 'discount_price',
                'value' => function($model) {
                    return number_format($model->discount_price, '0', '.', ' ');
                },
                'format' => 'html'
            ],
            //'category.title_ru',
            //'color_id',
            //'type_id',
            'updated_at:date',

            [
                'attribute' => 'status',
                'value' => function($model)
                {
                    return $model->status == 1 ? '<p style="color:#0b58a2">Published</p>' : '<p style="color:#f00">Not published</p>';
                },
                'format' => 'html',
            ],
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
