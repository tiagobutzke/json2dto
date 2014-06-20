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
use Json2Dto\Template\AddMethod;
use Json2Dto\Template\Argument;
use Json2Dto\Template\GetMethod;
use Json2Dto\Template\SetMethod;

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
     * @var array
     */
    protected $objects;

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

    /**
     * Load json content and save classes format in memory
     *
     * @throws Exceptions\JsonDecodeProblemException
     */
    public function load()
    {
        $this->loadJson();
        if ($this->json == null) {
            throw new JsonDecodeProblemException(
                "It's not possible decode json content. Please, verify the json syntax and try again."
            );
        }

        $this->loadNode($this->json);
        var_dump($this->objects);
    }

    /**
     * Trigger a json node
     *
     * @param \stdClass $node
     * @param string $object
     */
    protected function loadNode(\stdClass $node, $object = null)
    {
        $properties = get_object_vars($node);

        foreach ($properties as $property => $value) {
            if ($property == '') {
                continue;
            }

            // is a object
            if ($this->isInternalType($property) && is_object($value)) {
                $this->objects[$property];
                $this->loadNode($value, $property);
            }

            // is a collection
            if ($this->isInternalType($property) && is_array($value)) {
                $this->objects[$object]['arguments'] .= sprintf(
                    Argument::getTemplate(),
                    ucfirst($property),
                    lcfirst($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    AddMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
            }

            // is a property
            if ($this->isInternalType($property) && $this->isInternalType($value)) {
                $this->objects[$object]['arguments'] .= sprintf(
                    Argument::getTemplate(),
                    lcfirst($property),
                    lcfirst($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    SetMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
            }
        }
    }

    protected function isInternalType($property)
    {
        return (is_string($property) || is_int($property) || is_bool($property) || is_float($property));
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