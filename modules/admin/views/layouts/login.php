<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\modules\admin\assets\LoginAssets;
use yii\helpers\Html;

LoginAssets::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
<body>
<?php $this->beginBody() ?>
<body class="fix-header fix-sidebar">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" ></circle>
    </svg>
</div>
<!-- Main wrapper  -->
<div id="main-wrapper">
    <?= $content; ?>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>