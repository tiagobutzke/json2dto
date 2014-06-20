<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/19/14
 * Time: 11:40 PM
 */

namespace Json2Dto\Util;

abstract class Filter
{
    /**
     * Verify if a partial string exists in array
     *
     * @param array $array
     * @param array $params
     *
     * @return array
     */
    public static function filterArrayByPartialMatch(array $array, array $params)
    {
        return array_filter($array, function($element) use($params) {
            foreach ($params as $param => $value) {
                return (strpos($element, $param) !== false);
            }
        });
    }
} 