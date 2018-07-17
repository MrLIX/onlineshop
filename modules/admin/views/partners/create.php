<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partners */

$this->title = Yii::t('app', 'Create Partners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
