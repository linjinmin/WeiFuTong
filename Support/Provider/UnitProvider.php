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

        $params = $this->app->getPayConstructParams();

        // TODO: Implement register() method.
        $this->app->bind(Constant::PROVIDER_UNIT, function () use ($params) {
            return new Unit(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}
