<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:20 PM
 */

namespace Json2Dto\Util;


abstract class Format
{
    /**
     * Format string to class name format
     *
     * @param $name
     *
     * @return string
     */
    public static function className($name)
    {
        $name = str_replace(array('-', '_'), ' ', $name);
        $name = ucwords(strtolower($name));
        $name = str_replace(' ', '', $name);

        return $name;
    }

    /**
     * Format string to param name format
     *
     * @param $name
     *
     * @return string
     */
    public static function paramName($name)
    {
        $name = str_replace(array('-', '_'), ' ', $name);
        $name = ucwords(strtolower($name));
        $name = lcfirst($name);
        $name = str_replace(' ', '', $name);

        return $name;
    }

    /**
     * Format string to method name format
     *
     * @param $name
     *
     * @return string
     */
    public static function methodName($name)
    {
        self::paramName($name);

        return $name;
    }

}