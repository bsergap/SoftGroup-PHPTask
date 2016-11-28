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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/dataTables/css/jquery.dataTables.min.css',
        // 'css/buttons.dataTables.min.css',
        // 'css/editor.dataTables.min.css',
        // 'css/select.dataTables.min.css',
        'css/site.css',
    ];
    public $js = [
        // 'js/jquery-1.12.3.js',
        'plugins/dataTables/js/jquery.dataTables.min.js',
        // 'js/dataTables.buttons.min.js',
        // 'js/dataTables.editor.min.js',
        // 'js/dataTables.select.min.js',
        'plugins/countdown/js/jquery.countdown.min.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
