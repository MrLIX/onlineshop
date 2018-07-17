<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payment Methods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-method-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Payment Method'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute' => 'path',
                'value' => function($model){
                    return '<img src="/uploads/'.$model->path.'" width="100px">';
                },
                'format' => 'raw',

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
