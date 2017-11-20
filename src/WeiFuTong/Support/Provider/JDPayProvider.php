<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:42
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\JDPay;
use WeiFuTong\Interfaces\ServiceProvider;

class JDPayProvider implements ServiceProvider
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
        $this->app->bind('jdpay', function () use ($params) {
            return new JDPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }


}