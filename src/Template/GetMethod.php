<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:27 AM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

class GetMethod implements TemplateInterface
{
    protected static $template = '
    /**
     * Get %1$s
     *
     * @return %2$s
     */
     public function get%3$s()
     {
        return $this->%1$s;
     }
    ';

    public static function getTemplate()
    {
        return self::$template;
    }
} 