<?php
/**
 * Created by PhpStorm.
 * User: Farhodjon
 * Date: 09.03.2018
 * Time: 17:05
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class LoginAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin/bootstrap.min.css',
        'css/admin/helper.css',
        'css/admin/style.css',
    ];
    public $js = [
        'js/admin/sticky-kit.min.js',
        'js/admin/jquery.slimscroll.js',
        'js/admin/metismenu.min.js',
        'js/admin/custom.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}