<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:25 AM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

class SetMethod implements TemplateInterface
{
    protected static $template = '
    /**
     * Set %1$s
     *
     * @param %3$s $%1$s
     */
     public function set%2$s($%1$s)
     {
        $this->%1$s = $%1$s;
     }
     ';

    public static function getTemplate()
    {
        return self::$template;
    }
} 