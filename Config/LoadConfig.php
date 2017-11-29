<?php

namespace WeiFuTong\Config;

use \Exception;

/**
 * 配置类
 */
class LoadConfig
{
    // 容器等配置
    private $config;
    // 账号配置
    private $accountConfig;
    // 检验账号配置数组
    private $accountConfigKey = [
        'mch_id'  => '商户号',
        'mch_key' => '密钥',
    ];



    CONST CONFIG_PATH = __DIR__ . '/Conf/app.php';
    CONST ACCOUNT_CONFIG_PATH =  CONF_DIR . '/wft_pay_config.ini';

    /**
     * LoadConfig constructor.
     * @param string $setting 加载的用户配置是dev还是prod
     */
    public function __construct($setting = 'dev')
    {
        // 初始化
        $this->bootstrap($setting);
    }

    /**
     * 初始化
     * @throws Exception
     */
    public function bootstrap($setting)
    {
        // 加载容器配置
        $this->loadProvider();

        if (empty($this->config)) {
            throw new Exception("load config error,load fail" . self::CONFIG_PATH, 1);
        }

        // 加载用户账号配置
        $this->loadAccount($setting);

        if (empty($this->accountConfig)) {
            throw new Exception("load config error,load account config fail" . self::CONFIG_PATH, 1);
        }

        // 判断account是否配置错误
        $this->checkAcoountConfig();
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
     * 获取服务映射
     * @return array
     */
    public function getProviders()
    {
        return $this->config['providers'];
    }


    /**
     * 加载容器等配置
     */
    private function loadProvider()
    {
        $this->config = include self::CONFIG_PATH;
    }


    /**
     * 加载用户账号配置
     * @param $setting
     */
    private function loadAccount($setting)
    {
        $this->accountConfig =  parse_ini_file(self::ACCOUNT_CONFIG_PATH, TRUE);
        $this->accountConfig = $this->accountConfig[$setting];
    }

    /**
     * 判断账号配置是否正确
     * @throws Exception
     */
    private function checkAcoountConfig()
    {
        foreach ($this->accountConfigKey as $key => $desc) {
            if (!isset($this->accountConfig[$key])) {
                throw new Exception('account config error', 1);
            }
        }
    }

    /**
     * 获取配置中的mch_id , key
     * @return array
     */
    private function getAccountConfig()
    {
        return [$this->accountConfig['mch_id'], $this->accountConfig['mch_key']];
    }


}
