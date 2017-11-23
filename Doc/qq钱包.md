
### 所有接口参数相同, 但data 请求参数不同

| 参数    | 类型  |  必填 |  说明  |
| ------ | ----- |  -----| ----   |
| data | array   | 必填  | 请求参数|
| timeOut | int |  选填  | 超时时间默认25|
| logPath | int | 选填   | 日志路径默认/api/curl_post|


### 返回数据

| 参数    | 类型  |  说明  |
| ------ | ----- |----   |
| code | int   | 返回状态码|
| msg | string |  信息|
| data | array | 返回数据|

#### code 码定义
- 200
  - 请求成功
- 201
  - 请求成功，支付失败
- 202
  - 请求成功，支付结果未知
- 203
  - 请求成功，返回的签名验证没有通过
- 300
  - 请求超时

---------

## TenPay.php   qq钱包支付接口

### 1. 公众号支付 初始化请求API
```php

    $wft->tenpay->tenpayJsPay($data, $timeOut, $logPath);
```

#### 请求data及返回data详细信息地址
>* https://open.swiftpass.cn/openapi/doc?index_1=13&index_2=1&chapter_1=758&chapter_2=778

-------

### 2. 扫码支付  支付API
```php

    $wft->tenpay->tenpayNative($data, $timeOut, $logPath);
```

#### 请求data及返回data详细信息地址
>* https://open.swiftpass.cn/openapi/doc?index_1=14&index_2=1&chapter_1=787&chapter_2=798

-------

### 3. wap支付 支付API
```php

    $wft->tenpay->tenpayWapPay($data, $timeOut, $logPath);
```

#### 请求data及返回data详细信息地址
>* https://open.swiftpass.cn/openapi/doc?index_1=31&index_2=1&chapter_1=820&chapter_2=821

-------
