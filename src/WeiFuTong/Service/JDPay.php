<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:39
 */

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class JDPay extends PayBase
{

    use ResponseHandle;
    use RequestHandler;

    // 支付API
    const SERVICE_JD_PAY_NATIVE = 'pay.jdpay.native';
    // 初始化请求接API
    const SERVICE_JD_PAY_JSPAY = 'pay.jdpay.jspay';

    /**
     * JDPay constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }



    /**
     * 支付API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function jdpayNative($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_JD_PAY_NATIVE);

        // 调用支付
        $res = $this->postRequest();

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }


    /**
     * 初始化请求接API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function jdpayJsPay($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_JD_PAY_JSPAY);

        // 调用支付
        $res = $this->postRequest();

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

}