<?php

namespace tkight\middleware;

use ReflectionClass;
use tkight\attribute\Permission;
use tkight\exception\PermitException;

/**
 * 权限中间件
 * 
 */
class PermitMiddleware
{
    public function handle($request, $next)
    {
        // 自定义 Request 必须提供 permissions 方法获取权限。
        $tags = $request->permissions();
        $app = app('http')->getName();

        // 控制器权限验证
        $cname = $request->controller();
        $cclass = new ReflectionClass("app\\$app\\controller\\$cname");
        $cattrs = $cclass->getAttributes(Permission::class);
        foreach ($cattrs as $cattr) {
            if (!$cattr->newInstance()->permit($tags)) {
                throw new PermitException();
            }
        }

        // 操作权限验证
        $aname = $request->action();
        $aclass = $cclass->getMethod($aname);
        $aattrs = $aclass->getAttributes(Permission::class);
        foreach ($aattrs as $aattr) {
            if (!$aattr->newInstance()->permit($tags)) {
                throw new PermitException();
            }
        }

        return $next($request);
    }
}
