<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeliveryPrice */

$this->title = Yii::t('app', 'Create Delivery Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delivery Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
