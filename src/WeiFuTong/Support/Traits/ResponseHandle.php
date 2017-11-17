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
    /**
     * 将数据转为XML
     * @param $array
     * @return string
     */
    private static function toXml($array){
        $xml = '<xml>';
        forEach($array as $k=>$v){
            $xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
        }
        $xml.='</xml>';
        return $xml;
    }


    /**
     * 将xml转化为数组
     * @param string $xmlSrc
     * @return array|bool
     */
    private function parseXML($xmlSrc){
        if(empty($xmlSrc)){
            return false;
        }
        $array = array();
        $xml = simplexml_load_string($xmlSrc);
        $encode = $this->getXmlEncode($xmlSrc);

        if($xml && $xml->children()) {
            foreach ($xml->children() as $node){
                //有子节点
                if($node->children()) {
                    $k = $node->getName();
                    $nodeXml = $node->asXML();
                    $v = substr($nodeXml, strlen($k)+2, strlen($nodeXml)-2*strlen($k)-5);

                } else {
                    $k = $node->getName();
                    $v = (string)$node;
                }

                if($encode!="" && $encode != "UTF-8") {
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
    private function getXmlEncode($xml) {
        $ret = preg_match ("/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr);
        if($ret) {
            return strtoupper ( $arr[1] );
        } else {
            return "";
        }
    }
}