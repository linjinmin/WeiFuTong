<?php

namespace WeiFuTong\Container;

/**
 * 容器
 */
class Container
{

    // 注入的实例
    private static $instance;

    // 注入的闭包
    private static $binds;

    /**
     * 绑定服务容器
     * @param  string $abstract
     * @param  instance|closure $concrete
     * @return null
     */
    public static function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure) {
            self::$binds[$abstract] = $concrete;
        } else {
            self::$instance = $concrete;
        }
    }

    /**
     * 获取在闭包中的实例
     * @param  string $abstract
     * @param  array  $parameters
     * @return mixed
     */
    public static function make($abstract, $parameters = [])
    {
        if (isset(self::$instance[$abstract])) {
            return self::$instance[$abstract];
        }

        $object = self::$resolve($abstract, $parameters);

        self::$instance[$abstract] = $object;

        unset(self::$binds[$abstract]);

        return $object;
    }

    /**
     * 解析闭包
     * @param  string $abstract
     * @param  array  $parameters
     * @return mixed
     */
    public static function resolve($abstract, $parameters = [])
    {
        $object = call_user_func_array($binds[$abstract], $parameters);

        if (!$object instanceof stdClass) {
            throw new \Exception("Not found class {$abstract}", 1);
        }

        return $object;
    }

    /**
     * 判断是否绑定
     * @param  string $abstract
     * @return bool
     */
    public static function bound($abstract)
    {
        return (isset(self::$binds[$abstract]) || isset(self::$instance[$abstract])) ? true : false;
    }

}
