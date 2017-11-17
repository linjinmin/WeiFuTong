<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/16
 * Time: 10:45
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Service\Test;


class TestProvider implements ServiceProvider
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }


    public function register()
    {
        $params= $this->app->getPayConstructParams();

        // TODO: Implement register() method.
        $this->app->bind('test', function() use ($params) {
            return new Test(...$params);
        });

    }


    public function boot()
    {
        // TODO: Implement boot() method.
    }


}