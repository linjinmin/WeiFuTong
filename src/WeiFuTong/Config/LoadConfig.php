<?php

namespace WeiFuTong\Config;

use \Exception;

/**
 * 配置类
 */
class LoadConfig
{

    private $config;

    CONST CONFIGPATH = __DIR__ . '/../Support/app.php';

    public function __construct()
    {
        // 初始化
        $this->init();
    }

    /**
     * 初始化
     * @throws Exception
     */
    public function init()
    {
        // 加载配置
        $this->load();

        if (empty($this->config)) {
            throw new Exception("load config error, can't not load {$configPath}", 1);
        }
    }

    /**
     * 寻找该方法属于的类
     * @param  string $method 方法名
     * @throws Exception
     * @return string
     */
    public function methodBelong($method)
    {

        foreach ($this->config['method'] as $key => $value) {
            if (in_array($method, $value)) {
                return $key;
            }

            throw new Exception("{this is a not defined method : {$method}}", 1);
        }

    }

    /**
     * 获取账户配置
     * @throws Exception
     * @return array
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
        return $this->config['providers'];
    }


    /**
     * 加载配置
     */
    private function load()
    {
        $this->config = include self::CONFIGPATH;
    }


}
