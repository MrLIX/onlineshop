<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'lib/bootstrap/bootstrap.min.css',
        'lib/font_awesome/css/fontawesome-all.min.css',
        'lib/owl_carousel/owl.carousel.css',
        'lib/owl_carousel/owl.theme.css',
        'lib/owl_carousel/owl.transitions.css',
        'lib/slick/slick.css',
        'lib/xZoom/xzoom.css',
        'css/main.min.css',
        'css/responsive.min.css',
        'css/ie.min.css',
    ];
    public $js = [
        //'lib/jquery-3.2.1.min.js',
        'lib/bootstrap/bootstrap.min.js',
        'lib/owl_carousel/owl.carousel.min.js',
        'lib/slick/slick.min.js',
        'lib/xZoom/xzoom.min.js',
        'lib/masonry/masonry.pkgd.min.js',
        'js/custom.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
