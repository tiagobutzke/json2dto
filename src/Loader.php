<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 12:26 AM
 */

namespace Json2Dto;


use Json2Dto\Exceptions\FileNotExistsException;

class Loader
{
    /**
     * @var \SplFileObject
     */
    protected $file;

    /**
     * @param string $fileName
     * @throws Exceptions\FileNotExistsException
     */
    public function __construct($fileName)
    {
        if (!file_exists($fileName)) {
            throw new FileNotExistsException("The file [{$fileName}] do not exists.");
        }

        $this->file = new \SplFileObject($fileName);
    }
} 