<?php

namespace WeiFuTong\Support\Loader;

use WeiFuTong\Container\Container;
use WeiFuTong\Interfaces\LoadInterface;
use WeiFuTong\Reflection\ReflectionClass;

/**
 *  服务自动注册
 */
class ProviderLoader extends LoadInterface
{

    // 初始化
    public function init()
    {

        // 加载provider 中的映射
        $map = $this->getMapping();

        // 对所有映射生成反射闭包，保存于容器中
        foreach ($map as $key => $value) {

        }

    }

    private function getClosure($key, $value)
    {
        $reflection = new ReflectionClass($value);
    }

    /**
     * 获取loadConfig
     * @return mixed
     */
    private function getMapping()
    {
        $loadConfig = Container::make('loadConfig');

        return $loadConfig->getProvider();
    }

}
