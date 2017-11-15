<?php

namespace WeiFuTong\Container;

/**
 * 容器
 */
class Container
{

    // 注入的实例
    private $instance;

    // 注入的闭包
    private $binds;

    /**
     * 绑定服务容器
     * @param  string $abstract
     * @param  $concrete
     */
    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof \Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instance = $concrete;
        }
    }

    /**
     * 获取在闭包中的实例
     * @param  string $abstract
     * @param  array  $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        if (isset($this->instance[$abstract])) {
            return $this->instance[$abstract];
        }

        // 从闭包中解析
        $object = $this->resolve($abstract, $parameters);

        $this->instance[$abstract] = $object;

        unset($this->binds[$abstract]);

        return $object;
    }

    /**
     * 判断是否绑定
     * @param  string $abstract
     * @return bool
     */
    public function bound($abstract)
    {
        return (isset($this->binds[$abstract]) || isset($this->instance[$abstract])) ? true : false;
    }

    /**
     * 解析闭包
     * @param  string $abstract
     * @param  array  $parameters
     * @return mixed
     */
    private function resolve($abstract, $parameters = [])
    {
        $object = call_user_func_array($this->binds[$abstract], $parameters);

        return $object;
    }

}
