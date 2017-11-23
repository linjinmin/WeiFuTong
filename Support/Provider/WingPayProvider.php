<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:51
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\WingPay;
use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Support\System\Constant;

class WingPayProvider implements ServiceProvider
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
        $this->app->bind(Constant::PROVIDER_WINGPAY, function () use ($params) {
            return new WingPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}