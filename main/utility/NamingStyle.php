<?php

namespace tkight\utility;

abstract class NamingStyle
{
    /**
     * 蛇皮风格转帕斯卡风格
     *
     * @param string $source
     * @return string
     */
    public static function snakeToPascal($source)
    {
        return preg_replace_callback('/(?:^|_)([a-z])/', function ($matches) {
            return strtoupper($matches[1]);
        }, $source);
    }

    /**
     * 蛇皮风格转驼峰风格
     *
     * @param string $source
     * @return string
     */
    public static function snakeToCamel($source)
    {
        return preg_replace_callback('/_([a-z])/', function ($matches) {
            return strtoupper($matches[1]);
        }, $source);
    }

    /**
     * 帕斯卡风格转蛇皮风格
     *
     * @param string $source
     * @return string
     */
    public static function pascalToSnake($source)
    {
        return strtolower(preg_replace_callback('/(.)([A-Z])/', function ($matches) {
            return $matches[1] . '_' . $matches[2];
        }, $source));
    }
}
