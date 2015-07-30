<?php

namespace andrew72ru\slider;

use andrew72ru\slider\assets\SliderAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\widgets\InputWidget;

/**
 * This is just an example.
 */
class Slider extends InputWidget
{
    public $min;
    public $max;
    public $value1;
    public $value2;
    public $step;

    public function init()
    {
        if(!$this->min)
            $this->min = 0;
        if(!$this->max)
            $this->max = 100;
        if($this->min == $this->max)
            $this->min = 0;

        if(!$this->value1)
            $this->value1 = $this->min;

        if(!$this->value2)
            $this->value2 = $this->max;

        if(!$this->step)
            $this->step = 1;

        SliderAsset::register($this->view);
        $this->view->registerCss(".slider.slider-horizontal{width: 100%;}");
        $this->options['class'] = ArrayHelper::getValue($this->options, 'class', 'form-control');
        $this->options['id'] = $this->id;
        $this->options['data'] = [
            'slider-min' => $this->min,
            'slider-max' => $this->max,
            'slider-step' => $this->step,
            'slider-value' => [(int)$this->value1, (int)$this->value2]
        ];

        $this->view->registerJs("$('#{$this->id}').slider({tooltip:'always', formatter: function(value){return value[0] + ' – ' + value[1];}});");
    }

    public function run()
    {
//        $this->view->registerJs("console.log(" . Json::encode(VarDumper::dumpAsString($this->value2)) . ")");
        return Html::tag('div', Html::textInput(Html::getInputName($this->model, $this->attribute), null, $this->options), ['class' => 'form-group']);
    }
}
