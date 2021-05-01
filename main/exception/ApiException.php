<?php

namespace tkight\exception;

use think\exception\HttpResponseException;

/**
 * API 调用异常
 * 
 */
class ApiException extends HttpResponseException
{
    public function __construct($data = [], $code = 400)
    {
        if (empty($data['code'])) {
            $data['code'] = -1;
        }
        if (empty($data['message'])) {
            $data['message'] = '请求错误';
        }
        parent::__construct(json($data, $code));
    }
}
