<?php

return [

    'providers' => [

        WeiFuTong\Support\Provider\HelperProvider::class,
        WeiFuTong\Support\Provider\UnitProvider::class,
        WeiFuTong\Support\Provider\WeChatPayProvider::class,
        WeiFuTong\Support\Provider\AliPayProvider::class,
        WeiFuTong\Support\Provider\JDPayProvider::class,
        WeiFuTong\Support\Provider\TenPayProvider::class,
        WeiFuTong\Support\Provider\UnionPayProvider::class,
        WeiFuTong\Support\Provider\WingPayProvider::class,
        WeiFuTong\Support\Provider\DownloadProvider::class,

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
            // 非原生态预下单API,
            'tradePay',
        ],

        'wechat' => [
            // 统一下单API
            'wxNative',
            // 支付回调
            'handleNotify',
            // 初始化请求API， 客户端内使用
            'wxJsPay',
            // 微信客户端外使用场景,支付API
            'wxWapPay',
        ],

        'alipay' => [
            // 支付API
            'alipayNative',
            // 统一下单API
            'alipayJsPay',
        ],

        'tenpay' => [
            // 初始化请求API
            'tenpayJsPay',
            // 支付API
            'tenpayNative',
            // 支付API wap
            'tenpayWapPay',
        ],

        'jdpay' => [
            // 支付API
            'jdpayNative',
            // 初始化请求接API
            'jdpayJsPay',
        ],

        'wing' => [
            // 初始化请求接API
            'wingpayJsPay',
        ],

        'unionpay' => [
            // 支付API
            'unionpayNative',
        ],

        'download' => [
            // 下载单个商户时的对账单
            'downloadSingle',
            // 下载大商户下所有子商户的对账单
            'downloadAll',
            // 下载某渠道下所有商户的对账单
            'downloadChannel',
        ],


    ],

];
