<?php

namespace andrew72ru\slider;

use andrew72ru\slider\assets\SliderAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * This is just an example.
 */
class Slider extends InputWidget
{
    public $min;
    public $max;

    public function init()
    {
        if(!$this->min)
            $this->min = 0;
        if(!$this->max)
            $this->max = 100;
        if($this->min == $this->max)
            $this->min = 0;

        SliderAsset::register($this->view);
        $this->view->registerCss(".slider.slider-horizontal{width: 100%;}");
        $this->options['class'] = ArrayHelper::getValue($this->options, 'class', 'form-control');
        $this->options['id'] = $this->id;
        $this->options['data'] = [
            'slider-min' => $this->min,
            'slider-max' => $this->max,
            'slider-step' => 1,
            'slider-value' => [(int)$this->min, (int)$this->max]
        ];

        $this->view->registerJs("$('#{$this->id}').slider({tooltip:'always', formatter: function(value){return value[0] + ' – ' + value[1];}});");
    }

    public function run()
    {
        return Html::tag('div', Html::textInput(Html::getInputName($this->model, $this->attribute), null, $this->options), ['class' => 'form-group']);
    }
}
