<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 10:19
 */

namespace WeiFuTong\Support\Traits;

/**
 * 响应处理
 * Trait ResponseHandle
 * @package WeiFuTong\Support\Traits
 */
trait ResponseHandle
{

    // 错误码 对应 信息
    private $errorCodeMsg = [
        'SYSTEMERROR'                                => '接口返回错误',
        'Internal error'                             => '接口返回错误',
        'BANKERROR'                                  => '银行系统异常',
        '10003'                                      => '用户支付中，需要输入密码',
        'USERPAYING'                                 => '用户支付中，需要输入密码',
        'System error'                               => '接口返回错误',
        'aop.ACQ.SYSTEM_ERROR'                       => '接口返回错误',
        'ACQ.SYSTEM_ERROR'                           => '接口返回错误',
        'RULELIMIT'                                  => '当前交易异常',
        'TRADE_ERROR'                                => '103 暂无可用的支付方式,请绑定其它银行卡完成支付',
        'PARAM_ERROR'                                => '参数错误',
        'ORDERPAID'                                  => '订单已支付',
        'NOAUTH'                                     => '商户无权限',
        'AUTHCODEEXPIRE'                             => '二维码已过期，请用户在微信上刷新后再试',
        'NOTENOUGH'                                  => '余额不足',
        'NOTSUPORTCARD'                              => '不支持卡类型',
        'ORDERCLOSED'                                => '订单已关闭',
        'ORDERREVERSED'                              => '订单已撤销',
        'AUTH_CODE_ERROR'                            => '授权码参数错误',
        'AUTH_CODE_INVALID'                          => '授权码检验错误',
        'XML_FORMAT_ERROR'                           => 'XML格式错误',
        'SIGNERROR'                                  => '签名错误',
        'LACK_PARAMS'                                => '缺少参数',
        'NOT_UTF8'                                   => '编码格式错误',
        'BUYER_MISMATCH'                             => '支付帐号错误',
        'APPID_NOT_EXIST'                            => 'APPID不存在',
        'OUT_TRADE_NO_USED'                          => '商户订单号重复',
        'APPID_MCHID_NOT_MATCH'                      => 'appid和mch_id不匹配',
        'JMPT100027'                                 => '付款码已扣款',
        'ACQ.INVALID_PARAMETER'                      => '参数无效',
        'ACQ.ACCESS_FORBIDDEN'                       => '无权限使用接口',
        'ACQ.EXIST_FORBIDDEN_WORD'                   => '订单信息中包含违禁词',
        'ACQ.TOTAL_FEE_EXCEED'                       => '订单总金额超过限额',
        'ACQ.PAYMENT_AUTH_CODE_INVALID'              => '支付授权码无效',
        'ACQ.CONTEXT_INCONSISTENT'                   => '交易信息被篡改',
        'Auth code invalid'                          => '无效付款码',
        'ACQ.BUYER_BALANCE_NOT_ENOUGH'               => '买家余额不足',
        'ACQ.BUYER_BANKCARD_BALANCE_NOT_ENOUGH'      => '用户银行卡余额不足',
        'ACQ.ERROR_BALANCE_PAYMENT_DISABLE'          => '余额支付功能关闭',
        'ACQ.BUYER_SELLER_EQUAL'                     => '买卖家不能相同',
        'ACQ.TRADE_BUYER_NOT_MATCH'                  => '交易买家不匹配',
        'ACQ.BUYER_ENABLE_STATUS_FORBID'             => '买家状态非法',
        'ACQ.PULL_MOBILE_CASHIER_FAIL'               => '唤起移动收银台失败',
        'ACQ.MOBILE_PAYMENT_SWITCH_OFF'              => '用户的无线支付开关关闭',
        'ACQ.PAYMENT_FAIL'                           => '支付失败',
        'ACQ.BUYER_PAYMENT_AMOUNT_DAY_LIMIT_ERROR'   => '买家付款日限额超限',
        'ACQ.BEYOND_PAY_RESTRICTION'                 => '商户收款额度超限',
        'ACQ.BEYOND_PER_RECEIPT_RESTRICTION'         => '商户收款金额超过月限额',
        'ACQ.BUYER_PAYMENT_AMOUNT_MONTH_LIMIT_ERROR' => '买家付款月额度超限',
        'ACQ.ERROR_BUYER_CERTIFY_LEVEL_LIMIT'        => '买家未通过人行认证',
        'ACQ.PAYMENT_REQUEST_HAS_RISK'               => '支付有风险',
        'ACQ.NO_PAYMENT_INSTRUMENTS_AVAILABLE'       => '没用可用的支付工具',
        'ACQ.INVALID_STORE_ID'                       => '商户门店编号无效',
        'Auto code invalid'                          => '无效付款码',
    ];

    //  支付结果为未知
    private $payUnknown = [
        'SYSTEMERROR',
        'Internal error',
        'BANKERROR',
        '10003',
        'USERPAYING',
        'System error',
        'aop.ACQ.SYSTEM_ERROR',
        'ACQ.SYSTEM_ERROR',
    ];

    /**
     * 将xml转化为数组
     * @param string $xmlSrc
     * @return array|bool
     */
    private function parseXML($xmlSrc)
    {
        if (empty($xmlSrc)) {
            return false;
        }
        $array  = array();
        $xml    = simplexml_load_string($xmlSrc);
        $encode = $this->getXmlEncode($xmlSrc);

        if ($xml && $xml->children()) {
            foreach ($xml->children() as $node) {
                //有子节点
                if ($node->children()) {
                    $k       = $node->getName();
                    $nodeXml = $node->asXML();
                    $v       = substr($nodeXml, strlen($k) + 2, strlen($nodeXml) - 2 * strlen($k) - 5);

                } else {
                    $k = $node->getName();
                    $v = (string) $node;
                }

                if ($encode != "" && $encode != "UTF-8") {
                    $k = iconv("UTF-8", $encode, $k);
                    $v = iconv("UTF-8", $encode, $v);
                }
                $array[$k] = $v;
            }
        }
        return $array;
    }

    /**
     * 获取xml编码
     * @param $xml
     * @return string
     */
    private function getXmlEncode($xml)
    {
        $ret = preg_match("/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr);
        if ($ret) {
            return strtoupper($arr[1]);
        } else {
            return "";
        }
    }

    /**
     *是否签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
     *true:是
     *false:否
     */
    private function isTenpaySign($sign)
    {
        $signPars = "";
        ksort($this->res);
        foreach ($this->res as $k => $v) {
            if ("sign" != $k && "" != $v) {
                $signPars .= $k . "=" . $v . "&";
            }
        }

        $signPars .= "key=" . $this->key;

        $sign = strtolower(md5($signPars));

        $tenpaySign = strtolower($sign);

        return $sign == $tenpaySign;
    }

    /**
     * 结果处理
     * @return array      ['code', 'msg', 'data']
     */
    private function resHandle()
    {

        if ($this->res['status'] != 0) {
            // 支付状态码返回失败
            $code = 201;
            $msg  = $this->res['message'];
            $data = [];
        } else {
            // 支付状态吗返回成功
            // 判断签名
            if ($this->isTenpaySign($this->res['sign'])) {
                // 签名成功
                // 当返回状态与业务结果都为0时才表示成功
                if ($this->res['status'] == 0 && $this->res['result_code'] == 0) {
                    // 请求成功，支付成功
                    $code = 200;
                    $msg  = '支付成功';
                    $data = $this->res;
                } else {
                    // 请求成功，支付失败
                    // 判断支付结果，是否未知还是失败
                    $code = $this->judgePayStatus($this->res['err_code']);
                    $msg  = $this->res['err_msg'];
                    $data = $this->res;
                }
            } else {
                $code = 203;
                $msg  = '签名校验失败';
                $data = $this->res;
            }
        }

        return $this->buildReturn($code, $msg, $data);
    }

    /**
     * 判断支付结果是未知状态(201)  还是支付失败状态(202)
     * @param  string $errCode
     * @return int
     */
    private function judgePayStatus($errCode)
    {
        if (in_array($errCode, $this->payUnknown)) {
            return 201;
        }

        return 202;
    }

}
