<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 11:24
 */

namespace WeiFuTong\Service;

/**
 * 所有支付的基类
 * Class Base
 * @package WeiFuTong\Service
 */
abstract class PayBase
{
    // 账户
    protected $mchId;

    // 密钥
    protected $key;

    // 签名
    protected $sign;

    // 请求返回结果
    protected $res;

    // 日志保存路径
    protected $logPath;

    // 传输数据
    protected $data = [];

    // 请求路径
    protected $url = 'https://pay.swiftpass.cn/pay/gateway';

    // 签名类型
    protected $signType = 'MD5';

    // 字符集
    protected $charset = 'UTF-8';

    // 版本号
    protected $version = '2.0';

    // 超时时间
    protected $timeOut = 25;

    /**
     * PayBase constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        $this->mchId = $mchId;
        $this->key   = $key;
    }

    /**
     * 设置账户密码
     * @param $mchId
     * @param $key
     */
    public function setAccount($mchId, $key)
    {
        $this->mchId = $mchId;
        $this->key   = $key;
    }

    /**
     * 设置超时时间
     * @param int $timeOut
     */
    protected function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }

    /**
     * 设置日志
     * @param $logPath
     */
    protected function setLogPath($logPath)
    {
        $this->logPath = $logPath;
    }

    /**
     * 设置请求数据, 每次清空
     * @param array $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * 设置请求服务
     * @param string $service 请求服务
     */
    protected function setService($service)
    {
        $this->data['service'] = $service;
    }

    /**
     * 设置请求结果
     * @param array $res
     */
    protected function setRes($res)
    {
        $this->res = $res;
    }

    /**
     * 构建返回值
     * @param int $code 请求码
     * @param string $msg 信息
     * @param array $data 要保存到日志中的数据
     * @return array
     */
    protected function buildReturn($code, $msg, $data)
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
    }

}
