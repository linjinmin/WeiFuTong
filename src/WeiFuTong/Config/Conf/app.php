<?php

return [

    'providers' => [

        WeiFuTong\Support\Provider\TestProvider::class,
        WeiFuTong\Support\Provider\HelperProvider::class,

    ],

    'account' => [
        'mch_id'     => '7551000001',
        'key' => '9d101c97133837e13dde2d32a5054abb',
    ],


    'method' => [

        'test' => [
            'fc1',
        ],


        'helper' => [
            // 设置账户方法
            'setAccount',
            'getAccount',
        ],

    ],


];
