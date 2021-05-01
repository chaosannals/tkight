<?php

namespace tkight\attribute;

use Attribute;

/**
 * 权限属性
 * 
 */
#[Attribute(Attribute::TARGET_CLASS, Attribute::TARGET_METHOD)]
class Permission
{
    private $tags;

    public function __construct(...$tags)
    {
        $this->tags = $tags;
    }

    public function permit($tags)
    {
        $i = array_intersect($this->tags, $tags);
        return count($i) > 0;
    }
}
