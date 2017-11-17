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

    private function prepareRequest($data)
    {
        $data['version'] = $this->version;
        $data['charset'] = $this->charset;
        $data['mch_id']  = $this->mchId;
        $data['nonce_str'] = mt_rand(time(),time()+rand());
        
    }

    /**
     * 发送请求
     * @return array|mixed
     */
    private function postRequest()
    {
        //启动一个CURL会话
        $ch = curl_init();

        // 设置curl允许执行的最长秒数
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeOut);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        //发送一个常规的POST请求。
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        //要传送的所有数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);

        // 执行操作
        $res = curl_exec($ch);
        // 对返回进行处理
        $res = $this->resHandle($ch, $res);
        return $res;
    }


    /**
     * 请求结果处理
     * @param $ch
     * @param $res
     * @return array
     */
    private function resHandle($ch, $res)
    {

        if ($res == NULL) { // 请求无响应
            return $this->buildReturn(999, '', []);
        }

        $errCode = curl_errno($ch);
        $errorMsg = curl_error($ch);

        $logData = [
            'url'       => $this->logPath,
            'err_code'  => $errCode,
            'err_msg'   => curl_error($ch),
            'post_data' => $this->params,
            'method'    => 'post',
        ];

        return $this->buildReturn($errCode, $errorMsg, $logData);
    }


    /**
     *创建md5摘要,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
     * @return string
     */
    private function createSign() {
        $signPars = "";
        ksort($this->data);
        foreach($this->data as $k => $v) {
            if("" != $v && "sign" != $k) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $this->key;
        $sign = strtoupper(md5($signPars));
        return $sign;
    }

    /**
     * 构建返回值
     * @param int $code 请求码
     * @param string $msg 信息
     * @param array $data 要保存到日志中的数据
     * @return array
     */
    private function buildReturn($code, $msg, $data)
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
    }




}