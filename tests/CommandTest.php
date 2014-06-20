<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/19/14
 * Time: 10:29 PM
 */

namespace Json2DtoTests;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExec()
    {
        echo shell_exec('./src/json2dto');
    }
}
 