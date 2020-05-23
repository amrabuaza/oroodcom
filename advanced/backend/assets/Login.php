<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Login extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'loginLayout/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'loginLayout/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
        'loginLayout/vendor/animate/animate.css',
        'loginLayout/vendor/css-hamburgers/hamburgers.min.css',
        'loginLayout/vendor/animate/animate.css',
        'loginLayout/vendor/animsition/css/animsition.min.css',
        'loginLayout/vendor/select2/select2.min.css',
        'loginLayout/vendor/daterangepicker/daterangepicker.css',
        'loginLayout/css/util.css',
        'loginLayout/css/main.css',
    ];
    public $js = [
        'loginLayout/vendor/jquery/jquery-3.2.1.min.js',
        'loginLayout/vendor/animsition/js/animsition.min.js',
        'loginLayout/vendor/bootstrap/js/popper.js',
        'loginLayout/vendor/bootstrap/js/bootstrap.min.js',
        'loginLayout/vendor/select2/select2.min.js',
        'loginLayout/vendor/daterangepicker/moment.min.js',
        'loginLayout/vendor/daterangepicker/daterangepicker.js',
        'loginLayout/vendor/countdowntime/countdowntime.js',
        'loginLayout/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
