<?php

namespace WeiFuTong;

/**
 *  WeiFuTong
 */
class WeiFuTong
{

    private $app;


    /**
     * WeiFuTong constructor.
     */
    public function __construct()
    {
        $this->app = new AppService();
        // 初始化
        $this->app->bootstrap();
    }


    /**
     * 重载静态call方法
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.

        $this->app->call($name, $arguments);

    }


}
