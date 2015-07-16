<?php

namespace bazilio\yii\newrelic\handlers;

use yii\console\Application;

class ConsoleHandler extends BaseHandler
{
    public function bootstrap($app)
    {
        parent::bootstrap($app);

        $app->on(
            Application::EVENT_AFTER_ACTION,
            function () use ($app) {
                foreach ($app->requestedParams as $key => $value) {
                    $this->getAgent()->backgroundJob();
                    $this->getAgent()->addCustomParameter($key, var_export($value));
                }
            }
        );
    }
}