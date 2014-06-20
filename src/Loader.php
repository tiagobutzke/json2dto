<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/20/14
 * Time: 12:26 AM
 */

namespace Json2Dto;


use Json2Dto\Exceptions\FileNotExistsException;
use Json2Dto\Exceptions\JsonDecodeProblemException;

class Loader
{
    /**
     * @var \SplFileObject
     */
    protected $file;

    /**
     * @var \stdClass
     */
    protected $json;

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

    public function load()
    {
        $this->loadJson();
        if ($this->json == null) {
            throw new JsonDecodeProblemException(
                "It's not possible decode json content. Please, verify the json syntax and try again."
            );
        }

        
    }

    /**
     * Load file content and decode the json
     */
    protected function loadJson()
    {
        $lines = '';
        while (!$this->file->eof()) {
            $lines .= $this->file->fgets();
        }

        $this->json = json_decode($lines);
    }
} 