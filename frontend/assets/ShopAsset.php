<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/shop/main.css',
    ];
    public $js = [
        'js/shop/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}