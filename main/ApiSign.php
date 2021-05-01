<?php

namespace tkight;

use think\facade\Cache;

/**
 * 标识
 * 
 */
class ApiSign
{
    private $store;

    public function __construct($store='sign')
    {
        $this->store = $store;
    }

    public function save($info, $token = null)
    {
        if (empty($token)) {
            $token = bin2hex(random_bytes(16));
        }
        $tag = "__{$info['id']}__";

        // 唯一 TOKEN
        Cache::store($this->store)
            ->tag($tag)
            ->clear();

        // 设置
        Cache::store($this->store)
            ->tag($tag)
            ->set($token, $info);
    }

    public function load($token)
    {
        return Cache::store($this->store)
            ->get($token);
    }

    public function drop($token)
    {
        return Cache::store($this->store)
            ->delete($token);
    }
}
