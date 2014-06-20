<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 12:41 AM
 */

namespace Json2DtoTests;


use Json2Dto\Loader;

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    protected $loader;

    public function setUp()
    {
        parent::setUp();
        $this->loader = new Loader(__DIR__ . '/Resources/json_to_test.json');
    }

    public function testJsonContent()
    {
        $loader = $this->loader->load();
    }

    /**
     * @expectedException \Json2Dto\Exceptions\JsonDecodeProblemException
     */
    public function testJsonDecodeProblem()
    {
        $loader = new Loader(__DIR__ . '/Resources/json_broken_file.json');
        $loader->load();
    }

    /**
     * @expectedException \Json2Dto\Exceptions\FileNotExistsException
     */
    public function testFileExists()
    {
        new Loader('a');
    }
}
 