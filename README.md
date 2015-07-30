Yii2 Bootstrap Slider
=====================
Slider to choose a number range. Based on [seiyria/bootstrap-slider](https://github.com/seiyria/bootstrap-slider)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist andrew72ru/yii2-bootstrap-slider "*"
```

or add

```
"andrew72ru/yii2-bootstrap-slider": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
$form->field($model, 'property')
    ->widget(\andrew72ru\slider\Slider::className(), [
        'min' => 100, // Find min value form you model if you want
        'max' => 1000, // Find max value form you model if you want,
    ])
```