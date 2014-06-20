<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/19/14
 * Time: 10:24 PM
 */

namespace Json2Dto;


class Command
{
    protected $arguments = array(
        'json' => null,
        'directory' => null
    );

    protected $options = array(
        'namespace' => null
    );

    public static function main()
    {
        $command = new static;
        $command->run($_SERVER['argv']);
    }

    public function run(array $args)
    {
        
    }
} 