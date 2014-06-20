<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 1:19 AM
 */

namespace Json2Dto\Template;

use Json2Dto\TemplateInterface;

abstract class Single implements TemplateInterface
{
    protected static $argumentTemplate = '
/**
 * @var %s
 */
 protected $%s;
 ';

    protected static $setMethodTemplate = '
/**
 * Set %s
 *
 * @param $%s
 */
 public function set%s($%s)
 {
    $this->%s = $%s;
 }';

    protected static $getMethodTemplate = '
/**
 * Get %s
 *
 * @return %s
 */
 public function get%s()
 {
    return $this->%s;
 }';

    public static function getArgument()
    {
        return self::$argumentTemplate;
    }

    public static function getSetMethod()
    {
        return self::$setMethodTemplate;
    }

    public static function getGetMethod()
    {
        return self::$getMethodTemplate;
    }
} 