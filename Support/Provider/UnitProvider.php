<?php

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Service\Unit;
use WeiFuTong\Support\System\Constant;

class UnitProvider implements ServiceProvider
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function register()
    {

        $helper = $this->app->helper;

        // TODO: Implement register() method.
        $this->app->bind(Constant::PROVIDER_UNIT, function () use ($helper) {
            $params = $helper->getAccount();
            return new Unit(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}
