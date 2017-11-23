<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:35
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\TenPay;
use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Support\System\Constant;

class TenPayProvider implements ServiceProvider
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
        $this->app->bind(Constant::PROVIDER_TENPAY, function () use ($params) {
            return new TenPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }
}