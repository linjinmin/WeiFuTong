<?php

return [

    'providers' => [

        WeiFuTong\Support\Provider\HelperProvider::class,
        WeiFuTong\Support\Provider\UnitProvider::class,

    ],

    'account'   => [
        'mch_id' => '7551000001',
        'key'    => '9d101c97133837e13dde2d32a5054abb',
    ],

    'method'    => [

        'helper' => [
            // 设置账户方法
            'setAccount',
            'getAccount',
        ],

        'unit'   => [
            // 提交刷卡支付api
            'tradeMicropay',
            // 查询订单api
            'tradeQuery',
            // 撤销订单API
            'micropayReverse',
            // 申请退款API
            'tradeRefund',
            // 查询退款API
            'tradeRefundQuery',
        ],

    ],

];
