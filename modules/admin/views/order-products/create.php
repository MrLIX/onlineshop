<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderProducts */

$this->title = Yii::t('app', 'Create Order Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
