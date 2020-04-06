<?php

namespace bazilio\yii\newrelic\handlers;

use yii\base\Application;

class BaseHandler extends Handler
{
    public function bootstrap($app)
    {
        $app->on(
            Application::EVENT_BEFORE_ACTION,
            function () use ($app) {
                $this->getAgent()->nameTransaction(
                    ($app->controller->module ? $app->controller->module->id . '/' : '')
                    . $app->controller->id
                    . '/'
                    . $app->requestedAction->id);
            }
        );
    }
}
