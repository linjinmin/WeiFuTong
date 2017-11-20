<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 11:07
 */

namespace WeiFuTong\Support\Provider;

use WeiFuTong\Service\DownLoad;
use WeiFuTong\Interfaces\ServiceProvider;

class DownloadProvider implements ServiceProvider
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
        $this->app->bind('download', function () use ($params) {
            return new Download(...$params);
        });

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

}