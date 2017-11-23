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


];
