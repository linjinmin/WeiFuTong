<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 11:02
 */

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class Download extends PayBase
{

    use ResponseHandle;
    use RequestHandler;


    // 下载单个商户时的对账单
    const SERVICE_DOWNLOAD_SINGLE = 'pay.bill.merchant';
    // 下载大商户下所有子商户的对账单
    const SERVICE_DOWNLOAD_ALL = 'pay.bill.bigMerchant';
    // 下载某渠道下所有商户的对账单
    const SERVICE_DOWNLOAD_CHANNEL = 'pay.bill.agent';


    /**
     * DownLoad constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }


    /**
     * 下载单个商户时的对账单
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function downloadSingle($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_DOWNLOAD_SINGLE);

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
     * 下载大商户下所有子商户的对账单
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function downloadAll($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_DOWNLOAD_SINGLE);

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
     * 下载某渠道下所有商户的对账单
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function downloadChannel($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_DOWNLOAD_CHANNEL);

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