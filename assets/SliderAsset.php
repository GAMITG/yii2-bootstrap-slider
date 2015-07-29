<?php
/**
 * Date: 29.07.15
 * Time: 16:50
 */

namespace andrew72ru\slider\assets;


use yii\web\AssetBundle;

class SliderAsset extends AssetBundle
{
    public $sourcePath = '@bower/seiyria-bootstrap-slider';
    public $js = [
        'dist/bootstrap-slider.min.js'
    ];
    public $css = [
        'dist/css/bootstrap-slider.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}