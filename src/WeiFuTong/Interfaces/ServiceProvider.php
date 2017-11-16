<?php

namespace WeiFuTong\Interfaces;

/**
 *  服务加载类接口
 */
interface ServiceProvider
{
    // 绑定
    public function register();

    // 后置绑定
    public function boot();

}
