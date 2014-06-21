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
use Json2Dto\Template\ArgumentCollection;
use Json2Dto\Template\Classes;
use Json2Dto\Template\GetMethod;
use Json2Dto\Template\SetMethod;
use Json2Dto\Template\SetTypedMethod;
use Json2Dto\Template\UseNamespace;
use Json2Dto\Util\Format;

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
     * @var array
     */
    protected $queue = array();

    /**
     * @param string $fileName
     * @param array $options
     * @throws Exceptions\FileNotExistsException
     */
    public function __construct($fileName, array $options)
    {
        if (!file_exists($fileName)) {
            throw new FileNotExistsException("The file [{$fileName}] do not exists.");
        }

        $this->file = new \SplFileObject($fileName);
        $this->options = $options;
    }

    /**
     * Load json content and save classes format in memory
     *
     * @throws Exceptions\JsonDecodeProblemException
     *
     * @return array
     */
    public function load()
    {
        $this->loadJson();

        if ($this->json == null) {
            throw new JsonDecodeProblemException(
                "It's not possible decode json content. Please, verify the json syntax and try again."
            );
        }

        $this->queue['Dto'] = $this->json;
        $this->processQueue();
        $this->bindClasses();

        return $this->objects;
    }

    /**
     * Process files in queue
     */
    protected function processQueue()
    {
        foreach ($this->queue as $object => $properties) {
            $this->loadNode($properties, $object);
        }

        if (count($this->queue) > 0) {
            $this->processQueue();
        }
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
            if (is_object($value)) {
                $this->objects[$object]['arguments'] .= sprintf(
                    Argument::getTemplate(),
                    Format::className($property),
                    Format::paramName($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    SetTypedMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property)
                );
                $this->objects[$object]['use'] .= sprintf(
                    UseNamespace::getTemplate(),
                    $this->options['--namespace'].'\\'.Format::className($property)
                );

                $this->queue[$property] = $value;
            }

            if (is_array($value)) {
                $this->objects[$object]['arguments'] .= sprintf(
                    ArgumentCollection::getTemplate(),
                    Format::className($property),
                    Format::paramName($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    AddMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property)
                );
                $this->objects[$object]['use'] .= sprintf(
                    UseNamespace::getTemplate(),
                    $this->options['--namespace'].'\\'.Format::className($property)
                );

                $this->queue[$property] = $value[0];
            }

            if ($this->isInternalType($value)) {
                $this->objects[$object]['arguments'] .= sprintf(
                    Argument::getTemplate(),
                    Format::paramName($property),
                    Format::paramName($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    GetMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property)
                );
                $this->objects[$object]['methods'] .= sprintf(
                    SetMethod::getTemplate(),
                    Format::methodName($property),
                    Format::className($property),
                    gettype($value)
                );
            }
        }

        unset($this->queue[$object]);
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