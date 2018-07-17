<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SubCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sub Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'"width="80px" height="60px" >';
                },
                'format' => 'raw',

            ],
            [
                    'attribute' => 'category',
                    'value' => 'category.title_ru',
            ],
            'title_ru',
            'title_en',
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
