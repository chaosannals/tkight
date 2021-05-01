<?php

namespace tkight\exception;

/**
 * 权限异常
 * 
 */
class PermitException extends ApiException
{
    public function __construct()
    {
        parent::__construct([
            'code' => -3,
            'message' => '没有权限',
        ]);
    }
}
