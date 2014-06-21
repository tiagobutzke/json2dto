<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:43 PM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

abstract class ArgumentCollection implements TemplateInterface
{
    public static $template = '
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