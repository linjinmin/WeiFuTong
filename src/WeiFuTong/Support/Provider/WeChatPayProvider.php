<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 9:56
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Service\WeChatPay;

class WeChatPayProvider implements ServiceProvider
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
        $this->app->bind('wechat', function () use ($params) {
            return new WeChatPay(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }
}