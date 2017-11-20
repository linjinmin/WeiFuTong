<?php

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;
use \Closure;

class Unit extends PayBase
{

    use RequestHandler;
    use ResponseHandle;

    // 刷卡支付接口
    const SERVICE_MICRO_PAY = 'unified.trade.micropay';
    // 查询订单api
    const SERVICE_QUERY = 'unified.trade.query';
    // 撤销订单API
    const SERVICE_REVERSE = 'unified.micropay.reverse';
    // 申请退款API
    const SERVICE_REFUND = 'unified.trade.refund';
    // 查询退款API
    const SERVICE_REFUND_QUERY = 'unified.trade.refundquery';
    // 关闭订单API
    const SERVICE_CLOSE = 'unified.trade.close';
    // 非原生态预下单API
    const SERVICE_TRADE_PAY = 'unified.trade.pay';


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
        $this->setService(self::SERVICE_MICRO_PAY);

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

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $this->setRes($this->parseXML($res['data']));
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

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $this->setRes($this->parseXML($res['data']));
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

        // 对数据在进行一次处理,返回重要数据.
        if ($res['code'] == true) {
            $this->setRes($this->parseXML($res['data']));
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
        $this->setService(self::SERVICE_REFUND_QUERY);

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
     * 关闭订单API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function tradeClose($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_CLOSE);

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
     * 非原生态预下单API
     * @param $data
     * @param int $timeOut
     * @param string $logPath
     * @return array
     */
    public function tradePay($data, $timeOut = 25, $logPath = '1')
    {
        $this->setTimeOut($timeOut);

        // 设置请求数据
        $this->setData($data);

        // 设置请求服务
        $this->setService(self::SERVICE_TRADE_PAY);

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
     * 微信支付回调
     * @param Closure $closure
     * @return mixed|string
     */
    public function handleNotify(Closure $closure)
    {

        $xml = $_POST;

        if ($xml == null) {
            // 记录日志
            return 'fail';
        }

        $data = $this->parseXML($xml);
        // 获取数组对象
        $notify = $this->transformArrayToObject($data);
        // 获取支付结果
        $successful = $this->checkPaySuccess($data);

        return call_user_func_array($closure, [$notify, $successful]);
    }

    /**
     * 将数组转化为对象
     * @param $data
     * @return \StdClass
     * @throws \Exception
     */
    private function transformArrayToObject($data)
    {

        if (!is_array($data)) {
            throw new \Exception('transform Array To Object:param must be a array');
        }

        $class = new \StdClass();

        foreach ($data as $key => $value) {
            $class->$key = $value;
        }

        return $class;
    }


    /**
     * 判断支付回调结果是否成功支付
     * @param $data
     * @return bool
     */
    private function checkPaySuccess($data)
    {

        if ($data['status']==0 && $data['result_code ']==0) {
            return true;
        }

        return false;
    }

}
