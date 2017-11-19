<?php

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class Unit extends PayBase
{

    use RequestHandler;
    use ResponseHandle;

    // 刷卡支付接口
    const SERVICE_PAY = 'unified.trade.micropay';
    // 查询订单api
    const SERVICE_QUERY = 'unified.trade.query';
    // 撤销订单API
    const SERVICE_REVERSE = 'unified.micropay.reverse';
    // 申请退款API
    const SERVICE_REFUND = 'unified.trade.refund';
    // 查询退款API
    const SERVICE_REFUNDQUERY = 'unified.trade.refundquery';
    /**
     * Unit constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }

    /**
     * 提交刷卡支付api
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function tradeMicropay($data, $timeOut = 25, $logPath = '1')
    {

        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_PAY);

        // 调用支付
        $res = $this->postRequest();

        // 记录日志等操作.

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $res = $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

    /**
     * 查询订单api
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function tradeQuery($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_QUERY);

        // 调用支付
        $res = $this->postRequest();

        // 记录日志等操作.

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $res = $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

    /**
     * 撤销订单API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function micropayReverse($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_REVERSE);

        // 调用支付
        $res = $this->postRequest();

        // 记录日志等操作.

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $res = $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

    /**
     * 申请退款API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function tradeRefund($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_REFUND);

        // 调用支付
        $res = $this->postRequest();

        // 记录日志等操作.

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $res = $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

    /**
     * 查询退款API
     * @param  array $data 要请求的参数数组
     * @param  int $timeOut 默认25 设置超时时间
     * @param  string $logPath  默认 日志路径
     * @return array
     */
    public function tradeRefundQuery($data, $timeOut = 25, $logPath = '1')
    {
        // 设置时间
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_REFUNDQUERY);

        // 调用支付
        $res = $this->postRequest();

        // 记录日志等操作.

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $res = $this->setRes($this->parseXML($res['data']));
            // 请求成功, 如果请求失败（无响应，超时等）， 直接返回。
            $res = $this->resHandle();
        }

        return $res;
    }

}
