<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 7:30 PM
 */

namespace Json2Dto\Template;


abstract class UseNamespace
{
    protected static $template = 'use %s;
';

    public static function getTemplate()
    {
        return self::$template;
    }
} 