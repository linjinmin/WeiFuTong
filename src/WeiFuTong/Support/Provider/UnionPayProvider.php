<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:57
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\UnionPay;
use WeiFuTong\Interfaces\ServiceProvider;

class UnionPayProvider implements ServiceProvider
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
        $this->app->bind('unionpay', function () use ($params) {
            return new UnionPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}