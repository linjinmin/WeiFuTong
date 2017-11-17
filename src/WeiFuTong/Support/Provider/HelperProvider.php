<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 14:01
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\Help\Helper;
use WeiFuTong\Interfaces\ServiceProvider;

class HelperProvider implements ServiceProvider
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }


    public function register()
    {

        $container = $this->app->getContainer();

        // TODO: Implement register() method.
        $this->app->bind('helper', function() use ($container) {
            return new Helper($container);
        });

    }


    public function boot()
    {
        // TODO: Implement boot() method.
    }


}