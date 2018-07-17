<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.username',
            [
                'attribute' => 'amount',
                'value' => function($model)
                {
                    return number_format($model->amount, '0',' ',' ').' sum';
                }
            ],
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
            'name',
            'phone',
            'rayon.region.region',
            'rayon.rayon',
            'street',
            'index',
            'number_dom',
            'number_kv',
            'payment.name',
            'created_at:date',
            'updated_at:date',

        ],
    ]) ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Delivery address: <?= $model->rayon->region->region; ?>, <?= $model->rayon->rayon; ?>, <?= $model->address?></h4>
                </div>
                <div class="card-body">
                    <input id="lat" class="hidden" value="<?= $model->lat; ?>" />
                    <input id="lng" class="hidden" value="<?= $model->lang; ?>" />
                    <div class="mapsColl">

                        <div class="field" id="map3" style="height: 300px; width: 100% ">
                            <script>



                                function initMap( ) {
                                    var lat1 = Number(document.getElementById("lat").value);
                                    var lng1 = Number(document.getElementById("lng").value);
                                    var uluru = {lat: lat1, lng: lng1};
                                    var map = new google.maps.Map(document.getElementById('map3'), {
                                        zoom: 15,
                                        center: uluru

                                    });
                                    var marker = new google.maps.Marker({

                                        position: uluru,
                                        map: map
                                    });
                                }


                            </script>
                            <script async defer
                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlFroO7C1GYV5PKyg1IOXVvBp42eAZrBU&callback=initMap">
                            </script>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Order № <?= $model->id; ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Count</th>
                                <th>Amount</th>
                                <th>Color</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>View</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($model->orderProducts as $products): ?>
                                <tr>
                                    <td><?= $products->id; ?></td>
                                    <td><?= isset($products->product->title_ru) ? $products->product->title_ru : ''; ?></td>
                                    <td><?= number_format($products->product_price, '0',' ',' '); ?> сум</td>
                                    <td><?= $products->quantity; ?></td>
                                    <td><?= number_format($products->discount, '0',' ',' '); ?> сум</td>
                                    <td><?= $products->color; ?></td>
                                    <td><?= $products->type; ?></td>
                                    <td><?= isset($products->product->subCategory->title_ru) ? $products->product->subCategory->title_ru : ' '; ?></td>
                                    <td>
                                        <a href="<?= \yii\helpers\Url::to(['/product/product', 'id' => $products->product_id]); ?>">
                                            <i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

</div>
