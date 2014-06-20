<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 8:17 AM
 */

namespace Json2Dto\Template;


use Json2Dto\TemplateInterface;

abstract class Classes implements TemplateInterface
{
    public static $template = '
/**
 * ================================================
 * DTO Generated by Json2Dto
 *
 * @author Tiago Butzke <tiago.butzke@gmail.com>
 * ================================================
 */
 namespace %1$s;

 %2$s

 class %3$s
 {
    %4$s

    %5$s
 }
';

    public static function getTemplate()
    {
        return self::$template;
    }
} 