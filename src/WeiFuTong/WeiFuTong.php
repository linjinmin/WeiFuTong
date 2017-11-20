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

//    /**
//     * 重载魔术call方法
//     * @param $name
//     * @param $arguments
//     * @return mixed
//     */
//    public function __call($name, $arguments)
//    {
//        // TODO: Implement __call() method.
//
//        return $this->app->call($name, $arguments);
//    }


    /**
     * 重载魔术get方法
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->app->get($name);
    }

}
