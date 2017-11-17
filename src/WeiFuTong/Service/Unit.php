<?php

namespace WeiFuTong\Service;

use WeiFuTong\Support\Traits\RequestHandler;
use WeiFuTong\Support\Traits\ResponseHandle;

class Unit extends PayBase
{

    use RequestHandler;
    use ResponseHandle;

    // 刷卡支付接口
    CONST PAY_TYPE = 'unified.trade.micropay';


    /**
     * Unit constructor.
     * @param $mchId
     * @param $key
     */
    public function __construct($mchId, $key)
    {
        parent::__construct($mchId, $key);
    }





    public function tradeMicroPay($data, $timeOut)
    {
        $this->timeOut = $timeOut;



    }









}
