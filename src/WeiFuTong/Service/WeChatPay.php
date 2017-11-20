<?php

namespace WeiFuTong\Service;

use \Closure;
use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class WeChatPay extends PayBase
{
    use RequestHandler;
    use ResponseHandle;

    // 用户打开微信扫一扫.扫描商户的二维码完成支付
    // 统一下单API
    const SERVICE_WX_NATIVE = 'pay.weixin.native';

    // 适用于微信特客户端(内)请求微信支付场景
    // 初始化请求API
    const SERVICE_WX_JSPAY = 'pay.weixin.jspay';

    // 适用于微信客户端（外）手机浏览器请求微信支付场景
    // 支付API
    const SERVICE_WX_WAP_PAY = 'pay.weixin.wappay';

    // 原生态预下单API
    const SERVICE_WX_RAW_APP = 'pay.weixin.raw.app';


    /**
     * WeChatPay constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }




    /**
     * 统一下单API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function wxNative($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_WX_NATIVE);

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
     * 初始化请求API， 小程序
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array|mixed
     */
    public function wxJsPay($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_WX_JSPAY);

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
     * 支付API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array|mixed
     */
    public function wxWapPay($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_WX_WAP_PAY);

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
     * 原生态预下单API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array|mixed
     */
    public function wxRawApp($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_WX_RAW_APP);

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
