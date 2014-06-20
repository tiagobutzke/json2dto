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
use Json2Dto\Template\Classes;
use Json2Dto\Template\GetMethod;
use Json2Dto\Template\SetMethod;
use Json2Dto\Template\SetTypedMethod;
use Json2Dto\Template\UseNamespace;

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
    protected $options;

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
    public function load($options)
    {
        $this->options = $options;
        $this->loadJson();
        if ($this->json == null) {
            throw new JsonDecodeProblemException(
                "It's not possible decode json content. Please, verify the json syntax and try again."
            );
        }

        $this->loadNode($this->json);
        $this->bindClasses();
    }

    /**
     * Bind loaded classes
     */
    protected function bindClasses()
    {
        foreach ($this->objects as $object => $value) {
            $this->objects[$object]['class'] = sprintf(
                Classes::getTemplate(),
                $this->options['--namespace'],
                $this->objects[$object]['use'],
                ucfirst($object),
                $this->objects[$object]['arguments'],
                $this->objects[$object]['methods']
            );
            var_dump($this->objects[$object]['class']);
        }
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
                $this->objects[$property]['arguments'] .= sprintf(
                    Argument::getTemplate(),
                    ucfirst($property),
                    lcfirst($property)
                );
                $this->objects[$property]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
                $this->objects[$property]['methods'] .= sprintf(
                    SetTypedMethod::getTemplate(),
                    lcfirst($property),
                    ucfirst($property)
                );
                $this->objects[$property]['use'] .= sprintf(
                    UseNamespace::getTemplate(),
                    $this->options['--namespace'].'\\'.ucfirst($property)
                );
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
                $this->objects[$property]['use'] .= sprintf(
                    UseNamespace::getTemplate(),
                    $this->options['--namespace'].'\\'.ucfirst($property)
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
                    ucfirst($property),
                    gettype($value)
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