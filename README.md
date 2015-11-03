Newrelic instrumentation for Yii 2
==================================

This extension describes routes, action params and instruments views with newrelic end user monitoring scripts.
Supports console and web applications.

[![Latest Stable Version](https://poser.pugx.org/bazilio/yii2-newrelic/v/stable)](https://packagist.org/packages/bazilio/yii2-newrelic) 
[![Total Downloads](https://poser.pugx.org/bazilio/yii2-newrelic/downloads)](https://packagist.org/packages/bazilio/yii2-newrelic) 
[![Latest Unstable Version](https://poser.pugx.org/bazilio/yii2-newrelic/v/unstable)](https://packagist.org/packages/bazilio/yii2-newrelic) 
[![License](https://poser.pugx.org/bazilio/yii2-newrelic/license)](https://packagist.org/packages/bazilio/yii2-newrelic)

For license information check the [LICENSE](LICENSE)-file.

Requirements
------------

Works with newrelic agent with version >=3.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bazilio/yii2-newrelic
```

or add

```json
"bazilio/yii2-newrelic": "~0.0.1"
```

to the require section of your composer.json.


Configuration
-------------

To use this extension, you have to configure your components & bootstrap section your application configuration:

```php
return [
    'bootstrap' => ['newrelic'],
    'components' => [
        // ...
        'newrelic' => [
            'class' => 'bazilio\yii\newrelic\Newrelic',
            'name' => 'My App Frontend', // optional, uses Yii::$app->name by default
            'handler' => 'class/name', // optional, your custom handler
            'licence' => '...', // optional
            'enabled' => false // optional, default = true
        ]
    ],
];
```
