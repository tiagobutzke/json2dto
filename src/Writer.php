<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/21/14
 * Time: 1:12 AM
 */

namespace Json2Dto;


use Json2Dto\Exceptions\DirectoryNotExistsException;
use Json2Dto\Exceptions\ObjectsNotProcessedException;

class Writer
{
    /**
     * @var string
     */
    protected $directory;

    /**
     * @var array
     */
    protected $objects;

    /**
     * @param $directory
     * @param array $objects
     *
     * @throws Exceptions\ObjectsNotProcessedException
     * @throws Exceptions\DirectoryNotExistsException
     */
    public function __construct($directory, array $objects)
    {
        if (!is_dir($directory)) {
            throw new DirectoryNotExistsException("The directory [{$directory}] not exists.");
        }

        if (count($objects) == 0) {
            throw new ObjectsNotProcessedException("Objects not loaded.");
        }

        $this->directory = $directory;
        $this->objects = $objects;
    }

    public function write()
    {
        foreach ($this->objects as $objectName => $object)
        {
            $file = new \SplFileObject("{$this->directory}/{$objectName}.php", 'w');
            $file->fwrite(html_entity_decode($object['class']));
        }
    }
} 