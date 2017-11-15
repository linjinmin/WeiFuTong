<?php

namespace WeiFuTong\Reflection;

/**
 *  通过字符串获得类
 */
class ReflectionClass1 extends ReflectionClass
{

    /**
     * 判断类是否存在
     * @param  string  $className
     * @return boolean
     */
    public function isClassExist($className)
    {
        return class_exists($className);
    }

}
