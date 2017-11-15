<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 16:06
 */

namespace WeiFuTong;

use ReflectionClass;
use WeiFuTong\Config\LoadConfig;
use WeiFuTong\Container\Container;

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
    private function loadProviders()
    {
        $providers = $this->getProviders();

        $interfaceClass = new ReflectionClass(eiFuTong\Interfaces\ProviderInterface::class);

        // 将所有服务绑定容器中
        foreach ($providers as $value) {

        }
    }

    /**
     * 通过反射去调用provider方法,实现接口的方法
     * @param  string $provider
     * @return [type]           [description]
     */
    private function reflectionProvider($provider)
    {

        $providerClass = new ReflectionClass($provider);

        if ($providerClass->implementsInterface(WeiFuTong\Interfaces\ProviderInterface::class)) {
            // 是否继承指定服务接口，继承该接口则调用接口指定方法

        }

    }

    private function getInterfaceMethod($interface)
    {
        $class = new ReflectionClass($interface);

        $methods = $class->getMethods();

    }

    /**
     * 获取所有服务
     * @return array
     */
    private function getProviders()
    {
        $loadConfig = $this->container->make('loadConfig');

        return $loadConfig->getProviders();
    }

}
