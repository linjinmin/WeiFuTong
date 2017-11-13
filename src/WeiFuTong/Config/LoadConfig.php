<?php

namespace WeiFuTong\Config;

use \Exception;

/**
 * 配置类
 */
class LoadConfig
{

    private $config;

    public function __construct()
    {
        $configPath   = __DIR__ . '/../Support/config.php';
        $this->config = include $configPath;

        if (empty($this->config)) {
            throw new Exception("load config error, can't not load {$configPath}", 1);
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

}
