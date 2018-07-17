<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'name',
            [
                'attribute' => 'amount',
                'value' => function($model)
                {
                    return number_format($model->amount, '0',' ',' ');
                }
            ],
            'phone',

            //'street',
            //'index',
            //'number_dom',
            //'number_kv',
            //'lat',
            //'lang',
            //'delivery_time_id:datetime',
            //'payment_id',
            'created_at:date',
            [
                'attribute' => 'state',
                'value' => function($model){
                    if($model->state == 0):
                        return '<span style="color: #ff0c3e;">Pending</span>';
                    else:
                        return '<span style="color: #0b58a2">Done</span>';

                    endif;

                },
                'format' => 'html',
            ],
            //'updated_at',
            //'region_id',

            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]); ?>
</div>
