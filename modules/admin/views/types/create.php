<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Types */

$this->title = Yii::t('app', 'Create Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
