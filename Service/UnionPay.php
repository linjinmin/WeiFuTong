<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:55
 */

namespace WeiFuTong\Service;

use WeiFuTong\Support\System\Constant;
use WeiFuTong\Support\Traits\ResponseHandle;
use WeiFuTong\Support\Traits\RequestHandler;

class UnionPay extends PayBase
{

    use ResponseHandle;
    use RequestHandler;

    // 支付API
    const SERVICE_UNION_PAY_NATIVE = 'pay.unionpay.native';


    /**
     * UnionPay constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }

    /**
     * 支付API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function unionpayNative($data, $timeOut = Constant::TIMEOUT, $logPath = Constant::LOGPATH)
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置日志
        $this->setLogPath($logPath);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_UNION_PAY_NATIVE);

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