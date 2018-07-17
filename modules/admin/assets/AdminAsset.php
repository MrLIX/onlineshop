<?php
/**
 * Created by PhpStorm.
 * User: Farhodjon
 * Date: 09.03.2018
 * Time: 18:23
 */

namespace app\modules\admin\assets;


use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin/bootstrap.min.css',
        'css/admin/semantic.ui.min.css',
        'css/admin/pignose.calendar.min.css',
        'css/admin/owl.carousel.min.css',
        'css/admin/owl.theme.default.min.css',
        'css/admin/glyphicon.css',
        'css/admin/dropify.min.css',
        'css/admin/helper.css',
        'css/admin/style.css',
        'css/admin/site.css',
    ];
    public $js = [
        'js/admin/popper.js',
        //'js/admin/bootstrap.min.js',
        'js/admin/sticky-kit.min.js',
        'js/admin/jquery.slimscroll.js',
        'js/admin/metismenu.min.js',
        'js/admin/owl.carousel.min.js',
        'js/admin/owl.carousel-init.js',
        'js/admin/dropify.min.js',
        'js/admin/custom.min.js',
        'js/admin/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}