<?php

namespace bazilio\yii\newrelic;

use bazilio\yii\newrelic\handlers\BaseHandler;
use bazilio\yii\newrelic\handlers\ConsoleHandler;
use bazilio\yii\newrelic\handlers\WebHandler;
use SobanVuex\NewRelic\Agent;
use yii\base\BootstrapInterface;
use yii\base\Component;

/**
 * Class Newrelic
 * @package bazilio\yii\newrelic
 */
class Newrelic extends Component implements BootstrapInterface
{
    /**
     * @var bool Enable agent
     */
    public $enabled = true;
    /**
     * @var Agent
     */
    public $agent;

    /**
     * @var string App name
     */
    public $name;

    /**
     * @var string Licence key
     */
    public $licence = 'newrelic.license';

    /**
     * @var string handlers\Handler
     */
    public $handler;

    /**
     * @var bool Enable view instrumentation with newrelic scripts
     */
    public $enableEndUser = true;

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!$this->enabled) {
            return;
        }

        if ($this->handler) {
            $handler = new $this->handler(['newrelic' => $this]);
        } elseif ($app instanceof \yii\web\Application) {
            $handler = new WebHandler(['newrelic' => $this]);
        } elseif ($app instanceof \yii\console\Application) {
            $handler = new ConsoleHandler(['newrelic' => $this]);
        } else {
            $handler = new BaseHandler(['newrelic' => $this]);
        }

        $handler->bootstrap($app);
    }

    public function init()
    {
        parent::init();

        if ($this->enabled) {
            if (extension_loaded('newrelic')) {
                $this->name = $this->name ? $this->name : \Yii::$app->name;
                $this->agent = new Agent();
                $this->agent->setAppname($this->name, $this->licence);
            } else {
                $this->enabled = false;
                \Yii::$app->getLog()->getLogger()->log('Newrelic extension is not loaded', \yii\log\Logger::LEVEL_ERROR);
            }
        }
    }
}
