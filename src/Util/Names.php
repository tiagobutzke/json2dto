<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:20 PM
 */

namespace Json2Dto\Util;


abstract class Names
{
    /**
     * Format string to class name format
     *
     * @param $name
     *
     * @return string
     */
    public static function formatClassName($name)
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
    public static function formatParamName($name)
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
    public static function formatMethodName($name)
    {
        self::formatParamName($name);

        return $name;
    }

}