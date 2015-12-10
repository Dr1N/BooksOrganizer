<?php

namespace app\assets;

use yii\web\AssetBundle;

class BooksAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/booksHelper.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}