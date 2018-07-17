<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderProducts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'orders_id',
        [
            'attribute' => 'Заказчик',
            'value' => function($model){
                if(!empty($model->orders->user->username)){
                    return $model->orders->user->username;
                } else {
                    return 'Заказ без регистрации';

                }
            }
        ],
        [
            'attribute' => 'Имя',
            'value' => 'orders.name'
        ],
        [
            'attribute' => 'Телефон',
            'value' => 'orders.phone'
        ],
        [
            'attribute' => 'Дата заказа',
            'value' => function($model){
                return date('d.m.Y H:i',$model->orders->created_at);
            }
        ],
        [
                'attribute' => 'Продукт',
                'value'=> 'product.title'
        ],
        'quantity',
        'product_price',
        [
            'attribute' => 'Сумма',
            'value' => function($model){
                return number_format($model->quantity*$model->product_price,'0','.',' ');
            }
        ],
        'color',
        'type',
    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
        'dropdownOptions' => [
            'label' => 'Export All',
            'class' => 'btn btn-default'
        ]
    ])
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orders_id',
            [
                'attribute' => 'Заказчик',
                'value' => function($model){
                    if(!empty($model->orders->user->username)){
                        return $model->orders->user->username;
                    } else {
                        return 'Заказ без регистрации';

                    }
                }
            ],
            [
                'attribute' => 'Имя',
                'value' => 'orders.name'
            ],
            [
                'attribute' => 'Телефон',
                'value' => 'orders.phone'
            ],
            [
                'attribute' => 'Дата заказа',
                'value' => function($model){
                    return date('d.m.Y H:i',$model->orders->created_at);
                }
            ],
            [
                'attribute' => 'Продукт',
                'value'=> 'product.title'
            ],
            'quantity',
            'product_price',
            'color',
            'type',
            //'discount',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<style>
    .btn-group label {
        color: #000 !important;
    }
</style>
