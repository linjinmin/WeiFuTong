<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 10:49
 */

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class WingPay extends PayBase
{

    use ResponseHandle;
    use RequestHandler;

    // 初始化请求API
    const SERVICE_WING_PAY_JSPAY = 'pay.bestpay.jspay';

    /**
     * WingPay constructor.
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
    public function wingpayJsPay($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_WING_PAY_JSPAY);

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