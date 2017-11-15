<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 16:06
 */

namespace WeiFuTong;

use ReflectionClass;
use WeiFuTong\Container\Container;
use WeiFuTong\Config\LoadConfig;

class AppService
{


    private $container;


    /**
     * AppService constructor.
     */
    public function __construct()
    {
        $this->init();
    }


    /**
     * 绑定至容器中
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {

        $this->container->bind($abstract, $concrete);

    }

    /**
     * 初始化
     */
    private function init()
    {
        // 加载容器
        $this->getContainer();

        // 加载初始服务配置
        $this->loadConfig();
    }

    /**
     * 绑定初始服务配置
     */
    private function loadConfig()
    {
        $loadConfig = new LoadConfig();

        $this->container->bind('loadConfig', $loadConfig);
    }

    /**
     * 绑定闭包
     */
    private function getContainer()
    {
        $this->container = new Container();
    }


    /**
     * 自动加载服务
     */
    private function loadProvider()
    {



    }







}