<?php

namespace WeiFuTong\Config;

use \Exception;

/**
 * 配置类
 */
class LoadConfig
{

    private $config;

    CONST CONFIG_PATH = __DIR__ . '/Conf/app.php';

    public function __construct()
    {
        // 初始化
        $this->bootstrap();
    }

    /**
     * 初始化
     * @throws Exception
     */
    public function bootstrap()
    {
        // 加载配置
        $this->load();

        if (empty($this->config)) {
            throw new Exception("load config error, can't not load" . self::CONFIG_PATH, 1);
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
        }

        throw new Exception("{this is a not defined method : {$method}}", 1);
    }

    /**
     * 获取账户配置
     * @throws Exception
     * @return array
     */
    public function getAccount()
    {
        list($mchId, $secretKey) = $this->getAccountConfig();

        if (empty($mchId) || empty($secretKey)) {
            throw new Exception("Account is not set", 1);
        }

        return [$mchId, $secretKey];
    }


    /**
     * 设置账户
     * @param $mchId
     * @param $key
     */
    public function setAccount($mchId, $key)
    {
        $account = [
            'mch_id' => $mchId,
            'key'   => $key
        ];

        $this->config['account'] = $account;
    }

    /**
     * 获取服务映射
     * @return array
     */
    public function getProviders()
    {
        return $this->config['providers'];
    }


    /**
     * 加载配置
     */
    private function load()
    {
        $this->config = include self::CONFIG_PATH;
    }

    /**
     * 获取配置中的mch_id , key
     * @return array
     */
    private function getAccountConfig()
    {
        return [$this->config['account']['mch_id'], $this->config['account']['key']];
    }


}
