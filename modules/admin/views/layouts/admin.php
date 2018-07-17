<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\modules\admin\assets\AdminAsset;
use app\modules\admin\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Admin Panel application';

AdminAsset::register($this);
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
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <!-- Logo icon -->
<!--                        <b><img src="/img/logo.png" alt="homepage" class="dark-logo"/></b>-->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span><img src="/img/logo1.png" alt="homepage" class="dark-logo" style="max-width: 80px"/></span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted" href="javascript:void(0)">
                                <i class="mdi mdi-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted" href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <img src="/images/users/5.jpg" alt="user" class="profile-pic"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="<?= Url::to(['default/logout']) ?>" data-methods="POST""><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <?= $this->render('sidebar.php') ?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <?php if ( Yii::$app->controller->id !== 'default' ): ?>

                    <?php else: ?>
                        <?= Html::a('Create Product', [ 'products/create' ], [ 'class' => 'btn btn-primary' ]) ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-7 align-self-center">
                    <?php try {
                        echo Breadcrumbs::widget([
                            'tag' => 'ol',
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                    } catch ( Exception $e ) {
                        echo $e->getMessage();
                    } ?>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Start Page Content -->
                <?php if ( Yii::$app->controller->id !== 'default' ): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="admin-content">
                                <?= $content; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?= $content; ?>
                <?php endif; ?>
            </div>
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a>
                <div class="loader hidden"><img src="/images/2.gif"/></div>
            </footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>