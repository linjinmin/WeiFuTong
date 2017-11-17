<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 16:06
 */

namespace WeiFuTong;

use WeiFuTong\Config\LoadConfig;
use WeiFuTong\Container\Container;
use WeiFuTong\Interfaces\ServiceProvider;
use WeiFuTong\Reflection\ReflectionClassEx;
use WeiFuTong\Support\System\Constant;

class AppService
{

    private $container;

    /**
     * 初始化
     */
    public function bootstrap()
    {
        // 加载容器
        $this->bootContainer();

        // 加载初始服务配置
        $this->loadConfig();

        // 服务注册
        $this->bootProviders();

    }


    /**
     * 调用方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function call($name, $arguments)
    {
        $className = $this->searchMethodBelong($name);

        $class = $this->container->make($className);

        return call_user_func_array([$class, $name], $arguments);
    }

    /**
     * 绑定至容器中
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {
        $abstract = $this->abstractFilter($abstract);
        $this->container->bind($abstract, $concrete);
    }


    /**
     * 获取支付基类所需的参数
     * @return mixed
     */
    public function getPayConstructParams()
    {
        $loadConfig = $this->container->make(Constant::LOAD_CONFIG);

        return $loadConfig->getAccount();
    }

    /**
     * get container
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * 查询方法属于哪个服务
     * @param $name
     * @return mixed
     */
    private function searchMethodBelong($name)
    {
        $loadConfig = $this->container->make(Constant::LOAD_CONFIG);

        $belong = $loadConfig->methodBelong($name);

        return $belong;
    }

    /**
     * 绑定初始服务配置
     */
    private function loadConfig()
    {
        $loadConfig = new LoadConfig();

        $this->container->bind(Constant::LOAD_CONFIG, $loadConfig);
    }

    /**
     * 绑定闭包
     */
    private function bootContainer()
    {
        $this->container = new Container();
    }

    /**
     * 自动加载服务
     */
    private function bootProviders()
    {
        $providers = $this->getProviders();

        // 获取接口方法
        $interfaceClass = new ReflectionClassEx(ServiceProvider::class);
        $IMethods = $interfaceClass->getMethodsStrArr();

        // 将所有服务绑定容器中
        $this->reflectionProviders($providers, $IMethods);
    }

    /**
     * 通过反射去调用provider方法,实现接口的方法
     * @param  array $providers
     * @param  array $methods
     */
    private function reflectionProviders($providers, $methods)
    {

        foreach ($providers as $provider) {
            $providerClass = new ReflectionClassEx($provider);

            $ins = $providerClass->newInstance($this);

            if ($providerClass->implementsInterface(ServiceProvider::class)) {
                // 是否继承指定服务接口，继承该接口则调用接口指定方法
                $providerClass->callMethods($ins, $methods);
            }
        }

    }

    /**
     * 获取所有服务
     * @return array
     */
    private function getProviders()
    {
        $loadConfig = $this->container->make(Constant::LOAD_CONFIG);

        return $loadConfig->getProviders();
    }


    /**
     * 对abstract名进行调整
     * @param $abstract
     * @return string
     */
    private function abstractFilter($abstract)
    {
        $abstract = trim($abstract);
        $abstract = strtolower($abstract);
        return $abstract;
    }

}
