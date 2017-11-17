<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 11:24
 */

namespace WeiFuTong\Service;

use WeiFuTong\Container\Container;

/**
 * 所有支付的基类
 * Class Base
 * @package WeiFuTong\Service
 */
class PayBase
{
    // 请求路径
    protected $url;

    // 账户
    protected $mchId;

    // 密钥
    protected $key;

    // 传输数据
    protected $data=[];

    // 签名类型
    protected $signType = 'MD5';

    // 字符集
    protected $charset = 'UTF-8';

    // 版本号
    protected $version = '2.0';

    // 超时时间
    protected $timeOut = 25;

    // 日志保存路径
    protected $logPath = '/api/curl_post';


    /**
     * PayBase constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        $this->mchId = $mchId;
        $this->key = $key;
    }


    /**
     * 设置账户密码
     * @param $mchId
     * @param $key
     */
    public function setAccount($mchId, $key)
    {
        $this->mchId = $mchId;
        $this->key = $key;
    }




}