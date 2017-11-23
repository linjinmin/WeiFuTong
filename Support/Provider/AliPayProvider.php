<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:22
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\AliPay;
use WeiFuTong\Support\System\Constant;
use WeiFuTong\Interfaces\ServiceProvider;

class AliPayProvider implements ServiceProvider
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
        $this->app->bind(Constant::PROVIDER_ALIPAY, function () use ($params) {
            return new AliPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}