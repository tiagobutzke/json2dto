<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:33 AM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

abstract class Argument implements TemplateInterface
{
    protected static $template = '
    /**
     * @var %s
     */
     protected $%s = array();
    ';

    public static function getTemplate()
    {
        return self::$template;
    }
} 