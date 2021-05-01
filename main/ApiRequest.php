<?php

namespace tkight;

use think\Request;
use tkight\exception\ParamException;

class ApiRequest extends Request
{
    public const HEADER_SIGN_KEY = 'Tkight-API-Sign';

    public function __construct()
    {
        parent::__construct();
        $this->sign = new ApiSign();
    }

    /**
     * 获取权限。
     *
     * @return array
     */
    public function permissions()
    {
        $key = $this->header(self::HEADER_SIGN_KEY);
        if (empty($key)) {
            return [];
        }
        $info = $this->sign->load($key);
        if (empty($info)) {
            return [];
        }
        $this->sign->save($info, $key);
        return $info['permissions'];
    }

    public function operator()
    {
        $key = $this->header(self::HEADER_SIGN_KEY);
        if (empty($key)) {
            throw new ParamException("操作员ID为空");
        }
        return $this->sign->load($key);
    }
}
