<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Socials */

$this->title = Yii::t('app', 'Create Socials');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
