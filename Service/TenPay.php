<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:31
 */

namespace WeiFuTong\Service;

use WeiFuTong\Support\System\Constant;
use WeiFuTong\Support\Traits\ResponseHandle;
use WeiFuTong\Support\Traits\RequestHandler;

class TenPay extends PayBase
{

    use ResponseHandle;
    use RequestHandler;

    // 初始化请求API
    const SERVICE_TENPAY_JSPAY = 'pay.tenpay.jspay';

    // 支付API
    const SERVICE_TENPAY_NATIVE = 'pay.tenpay.native';

    // wap  支付API
    const SERVICE_TENPAY_WAP_PAY = 'pay.tenpay.wappay';



    /**
     * TenPay constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }


    /**
     * 初始化请求API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function tenpayJsPay($data, $timeOut = Constant::TIMEOUT, $logPath = Constant::LOGPATH)
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置日志
        $this->setLogPath($logPath);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_TENPAY_JSPAY);

        // 对数据进行处理
        $this->prepareRequest();

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
     * @return array
     */
    public function tenpayNative($data, $timeOut = Constant::TIMEOUT, $logPath = Constant::LOGPATH)
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置日志
        $this->setLogPath($logPath);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_TENPAY_NATIVE);

        // 对数据进行处理
        $this->prepareRequest();

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
     * 支付API, wap
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function tenpayWapPay($data, $timeOut = Constant::TIMEOUT, $logPath = Constant::LOGPATH)
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置日志
        $this->setLogPath($logPath);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_TENPAY_WAP_PAY);

        // 对数据进行处理
        $this->prepareRequest();

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