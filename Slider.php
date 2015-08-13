<?php

namespace andrew72ru\slider;

use andrew72ru\slider\assets\SliderAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

class Slider extends InputWidget
{
    public $min;
    public $max;
    public $value1;
    public $value2;
    public $step;
    public $tooltip;
    public $tick_unit = null;
    public $clientEvents = [];

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

	if(!$this->tooltip)
	    $this->tooltip = 'show';

        SliderAsset::register($this->view);
        $this->view->registerCss(".slider.slider-horizontal{width: 90%;}");
        $this->options['class'] = ArrayHelper::getValue($this->options, 'class', 'form-control');
        $this->options['id'] = $this->id;

        $defaults = [
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'orientation' => ArrayHelper::getValue($this->options, 'orientation', 'horizontal'),
            'value' => [(int)$this->value1, (int)$this->value2],
            'tooltip' => ArrayHelper::getValue($this->options, 'tooltip', 'show'),
            'tooltip_split' => ArrayHelper::getValue($this->options, 'tooltip_split', false),
            'tooltip_position' => ArrayHelper::getValue($this->options, 'tooltip_position', null),
            'handle' => ArrayHelper::getValue($this->options, 'handle', 'round'),
            'reversed' => ArrayHelper::getValue($this->options, 'reversed', false),
            'enabled' => ArrayHelper::getValue($this->options, 'enabled', true),
            'formatter' => new JsExpression(ArrayHelper::getValue($this->options, 'formatter', 'function(value){return value[0] + \' – \' + value[1];}')),
            'natural_arrow_keys' => ArrayHelper::getValue($this->options, 'natural_arrow_keys', false),
            'ticks' => ArrayHelper::getValue($this->options, 'ticks', [$this->min, $this->max]),
            'ticks_positions' => ArrayHelper::getValue($this->options, 'ticks_positions', []),
            'ticks_labels' => ArrayHelper::getValue($this->options, 'ticks_labels', [$this->min . ' ' . $this->tick_unit, $this->max . ' ' . $this->tick_unit]),
            'ticks_snap_bounds' => ArrayHelper::getValue($this->options, 'ticks_snap_bounds', 0),
            'scale' => ArrayHelper::getValue($this->options, 'scale', 'linear'),
            'focus' => ArrayHelper::getValue($this->options, 'focus', false)
        ];

        $this->view->registerJs("$('#{$this->id}').slider(" . Json::encode($defaults) . ");");
        foreach($this->clientEvents as $event_name => $event_function)
            $this->view->registerJs("$('#{$this->id}').on('{$event_name}', " . new JsExpression($event_function) . ")");
    }

    public function run()
    {
        return Html::tag('div', Html::textInput(Html::getInputName($this->model, $this->attribute), null, $this->options), ['class' => 'form-group text-center']);
    }
}
