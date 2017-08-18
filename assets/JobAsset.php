<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JobAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap-3.1.1.min.css',
        'css/style.css',
        'css/tourist.css'
       
    ];
    public $js = [
        'js/underscore-1.4.4.js',
        'js/backbone-1.0.0.js',
        'js/jquery-ui-1.10.2.custom.js',
        'js/tourist.js',
        'js/jquery-1.9.1.js',
        'js/jobtour.js'
    
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
