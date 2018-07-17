<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OurService */

$this->title = Yii::t('app', 'Create Our Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Our Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
