<?php

namespace WeiFuTong\Config;

use \Exception;

/**
 * 配置类
 */
class LoadConfig
{

    private $config;

    private $provider;

    public function __construct()
    {
        $this->init();
    }

    /**
     * 初始化
     * @return mixed
     */
    public function init()
    {
        $configPath     = __DIR__ . '/../Support/config.php';
        $providerPath   = __DIR__ . '/../Support/provider.php';
        $this->config   = include $configPath;
        $this->provider = include $providerPath;

        if (empty($this->config)) {
            throw new Exception("load config error, can't not load {$configPath}", 1);
        }

        if (empty($this->provider)) {
            throw new Exception("load provider error, can't not load {$providerPath}", 1);
        }
    }

    /**
     * 寻找该方法属于的类
     * @param  string $method 方法名
     * @return mixed;
     */
    public function methodBelong($method)
    {

        foreach ($this->config as $key => $value) {
            if (in_array($method, $value)) {
                return $key;
            }

            throw new Exception("{this is a not defined method : {$method}}", 1);
        }

    }

    /**
     * 获取账户配置
     * @return mixed
     */
    public function getAccount()
    {
        list($mchId, $secretKey) = $this->config['account'];

        if (empty($mchId) || empty($secretKey)) {
            throw new Exception("Account is not set", 1);
        }

        return [$mchId, $secretKey];
    }

    /**
     * 设置账户配置
     * @param string $mchId     商户号
     * @param [type] $secretKey 商户密匙
     */
    public function setAccount($mchId, $secretKey)
    {
        $account = [
            'mch_id'     => $mchId,
            'secret_key' => $secretKey,
        ];

        $this->config['account'] = $account;
    }

    /**
     * 获取服务映射
     * @return array
     */
    public function getProvider()
    {
        return $this->provider;
    }

}