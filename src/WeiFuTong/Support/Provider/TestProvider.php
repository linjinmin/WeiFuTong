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
        // TODO: Implement register() method.
        $this->app->bind('test', function() {
            return new Test();
        });

    }


    public function boot()
    {
        // TODO: Implement boot() method.
    }


}