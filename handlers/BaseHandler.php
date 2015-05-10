<?php

namespace bazilio\yii\newrelic\handlers;

use yii\base\Application;

class BaseHandler extends Handler
{
    public function bootstrap($app)
    {
        $app->on(
            Application::EVENT_BEFORE_REQUEST,
            function () use ($app) {
                $this->getAgent()->startTransaction($this->newrelic->name);
            }
        );

        $app->on(
            Application::EVENT_AFTER_ACTION,
            function () use ($app) {
                $this->getAgent()->nameTransaction($app->controller->id . '/' . $app->requestedAction->id);
            }
        );

        $app->on(
            Application::EVENT_AFTER_REQUEST,
            function () use ($app) {
                $this->getAgent()->endOfTransaction();
            }
        );
    }
}