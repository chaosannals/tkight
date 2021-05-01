<?php

namespace tkight\exception;

/**
 * 只写提示的异常。
 * 
 */
class ParamException extends ApiException
{
    public function __construct($message)
    {
        parent::__construct([
            'message' => $message
        ]);
    }
}
