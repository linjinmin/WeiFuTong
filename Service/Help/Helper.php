<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 14:00
 */

namespace WeiFuTong\Service\Help;

use WeiFuTong\Service\PayBase;
use WeiFuTong\Support\System\Constant;

class Helper
{

    // 容器
    private $container;


    /**
     * Helper constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }


    /**
     * 影响全局实例以及配置文件
     * @param string $mchId
     * @param string $key
     * @throws \Exception
     */
    public function setAccount($mchId, $key)
    {

        if (empty($mchId) || empty($key)) {
            throw new \Exception('mchId or key is null');
        }

        // 修改config的account
        $this->setLoadConfigAccount($mchId, $key);

        // 修改所有实例的account
        $this->setInstaceAccount($mchId, $key);
    }

    /**
     * 获取账户， 测试使用
     */
    public function getAccount()
    {
        return $this->getLoadConfigAccount();
    }

    /**
     * 设置配置的config
     * @param string $mchId
     * @param string $key
     */
    private function setLoadConfigAccount($mchId, $key)
    {
        $loadConfig = $this->container->make(Constant::LOAD_CONFIG);

        $loadConfig->setAccount($mchId, $key);
    }

    /**
     * 获取账户
     * @return mixed
     */
    private function getLoadConfigAccount()
    {
        $loadConfig = $this->container->make(Constant::LOAD_CONFIG);

        return $loadConfig->getAccount();
    }

    /**
     * 设置所有实例的account
     * @param $mchId
     * @param $key
     */
    private function setInstaceAccount($mchId, $key)
    {
        $instances = $this->container->getInstances();

        foreach ($instances as $instance) {
            if (method_exists($instance, 'setAccount') && get_parent_class($instance) == PayBase::class)
                $instance->setAccount($mchId, $key);
        }
    }

}