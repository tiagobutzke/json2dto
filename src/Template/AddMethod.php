<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:31 AM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

abstract class AddMethod implements TemplateInterface
{
    protected  static $template = '
    /**
     * Add %1$s
     *
     * @param $%1$s
     */
     public function add%2$s(%2$s $%1$s)
     {
        $this->%1$s[] = $%1$s;
     }
    ';

    public static function getTemplate()
    {
        return self::$template;
    }
} 