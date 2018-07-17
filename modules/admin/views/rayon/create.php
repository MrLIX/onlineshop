<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rayon */

$this->title = Yii::t('app', 'Create Rayon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rayons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rayon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
