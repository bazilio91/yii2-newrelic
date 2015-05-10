<?php

namespace bazilio\yii\newrelic\handlers;

use yii\base\Component;

abstract class Handler extends Component
{
    /**
     * @var \bazilio\yii\newrelic\Newrelic
     */
    public $newrelic;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    abstract public function bootstrap($app);

    /**
     * @return \NewRelic\NewRelic
     */
    protected function getAgent()
    {
        return $this->newrelic->agent;
    }
}