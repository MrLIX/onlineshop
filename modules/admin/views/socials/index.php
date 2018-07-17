<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SocialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Socials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Socials'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            'url:url',
            [
                'attribute' => 'status',
                'value' => function($model)
                {
                    return $model->status == 1 ? '<p style="color:#0b58a2">Published</p>' : '<p style="color:#f00">Not published</p>';
                },
                'format' => 'html',
            ],
            'order',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => ('{view} {update}'),
            ],
        ],
    ]); ?>
</div>
