<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:46
 */

namespace WeiFuTong\Support\Traits;

/**
 * 请求帮手语法糖
 * Trait RequestHandler
 * @package WeiFuTong\Support\Traits
 */
trait RequestHandler
{

    private function prepareRequest()
    {
        $this->data['version']   = $this->version;
        $this->data['mch_id']    = $this->mchId;
        $this->data['nonce_str'] = $this->createRandomStr();
        $this->data['sign']      = $this->createSign();
    }

    /**
     * 发送请求
     * @return array|mixed
     */
    private function postRequest()
    {
        // 对数据进行处理
        $this->prepareRequest();

        // 启动一个CURL会话
        $ch = curl_init();

        // 设置curl允许执行的最长秒数
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //发送一个常规的POST请求。
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        //要传送的所有数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->toXml($this->data));

        // 执行操作
        $res = curl_exec($ch);

        // 对返回进行处理
        $res = $this->requestResHandle($ch, $res);
        return $res;
    }

    /**
     * 请求结果处理
     * @param $ch
     * @param $res
     * @return array
     */
    private function requestResHandle($ch, $res)
    {

        $resCode = false;
        $msg     = '';
        $data    = [];

        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($res == null) {
            // 请求无响应
            $resCode = false;
            $msg     = "请求无响应:" . "call http err :" . curl_errno($ch) . " - " . curl_error($ch);
            $data    = [];
        } else if ($responseCode != '200') {
            // 请求失败
            $resCode = false;
            $msg     = "call http err httpcode=" . $responseCode;
            $data    = [];
        } else {
            $resCode = true;
            $msg     = '';
            $data    = $res;
        }

        return $this->buildReturn($resCode, $msg, $data);
    }

    /**
     *创建md5摘要,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
     * @return string
     */
    private function createSign()
    {
        $signPars = "";
        ksort($this->data);
        foreach ($this->data as $k => $v) {
            if ("" != $v && "sign" != $k) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $this->key;
        $sign = strtoupper(md5($signPars));
        return $sign;
    }

    /**
     * 将数据转为XML
     * @param $array
     * @return string
     */
    private static function toXml($array)
    {
        $xml = '<xml>';
        foreach ($array as $k => $v) {
            $xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
        }
        $xml .= '</xml>';
        return $xml;
    }

    /**
     * 生成随机字符串
     * @return string
     */
    private function createRandomStr()
    {
        return mt_rand(time(), time() + rand());
    }

}
