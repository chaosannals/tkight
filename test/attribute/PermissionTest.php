<?php

namespace tkight\attribute;

use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    public function testPermit()
    {
        $p = new Permission('test');
        $r = $p->permit(['test']);
        $this->assertTrue($r);
    }
}
