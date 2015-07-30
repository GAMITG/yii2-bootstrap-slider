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
        'min'       => 100,     // Find min value form you model if you want
        'max'       => 1000,    // Find max value form you model if you want
        'value1'    => 150,     // Optional, value to first slider init. Refer to min if not set
        'value2'    => 350,     // Optional, value to second slider init. Refer to max if not set
        'step'      => 1,       // Optional, refer to 1 if not set
    ])
```

Remember, slider send a `150,200` (comma separated) value to server. Tune you search model to split it or so.

For example

```php
// Value – is a string value of form field 
if(strpos($value, ',') !== false)
    $where = ['between', 'value', explode(',', $value)[0], explode(',', $value)[1]];
```

