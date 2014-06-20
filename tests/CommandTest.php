<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/19/14
 * Time: 10:29 PM
 */

namespace Json2DtoTests;

use Json2Dto\Command;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Json2Dto\Exceptions\FileNotExistsException
     */
    public function testFileExists()
    {
        array_push($_SERVER['argv'], 'a');
        array_push($_SERVER['argv'], 'b');
        Command::main();
    }

    /**
     * @expectedException \Json2Dto\Exceptions\ArgumentNotExistsException
     */
    public function testNoArguments()
    {
        Command::main();
    }

    protected function tearDown()
    {
        $_SERVER['argv'] = array();
    }
}
