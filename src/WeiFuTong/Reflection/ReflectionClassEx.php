<?php

namespace WeiFuTong\Reflection;

use ReflectionClass;

/**
 *  通过字符串获得类
 */
class ReflectionClassEx extends ReflectionClass
{


    /**
     * 获取方法名str数组
     * @return array
     */
    public function getMethodsStrArr()
    {
        $methods = $this->getMethods();

        $arr = [];

        foreach ($methods as $method) {
            $arr[] = $method->name;
        }

        return $arr;
    }


    /**
     * 调用方法
     * @param object $ins
     * @param array $methods
     */
    public function callMethods($ins, $methods)
    {
        foreach ($methods as $method) {
            if ($this->hasMethod($method)) {
                $classMethod = $this->getMethod($method);
                $classMethod->invoke($ins);
            }
        }
    }


}
