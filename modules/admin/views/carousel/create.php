<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Carousel */

$this->title = Yii::t('app', 'Create Carousel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
