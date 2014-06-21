<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/19/14
 * Time: 10:24 PM
 */

namespace Json2Dto;


use Json2Dto\Exceptions\ArgumentNotExistsException;
use Json2Dto\Util\Filter;

class Command
{
    protected $arguments = array(
        'json' => null,
        'directory' => null
    );

    protected $options = array(
        '--namespace' => 'Json2Dto'
    );

    public static function main()
    {
        $command = new static;
        $command->run($_SERVER['argv']);
    }

    public function run(array $args)
    {
        $this->handleArgs($args);
        $this->handleOptions($args);

        $loader = new Loader($this->arguments['json'], $this->options);
        $objects = $loader->load();
        $writer = new Writer($this->arguments['directory'], $objects);
    }

    /**
     * Define Options
     *
     * @param array $args
     */
    protected function handleOptions(array $args)
    {
        $options = Filter::filterArrayByPartialMatch($args, $this->options);

        if (count($options) > 0) {
            foreach ($options as $option) {
                $optionArray = explode('=', $option);
                $this->options[$optionArray[0]] = $optionArray[1];
            }
        }
    }

    /**
     * Define arguments
     *
     * @param array $args
     * @throws Exceptions\ArgumentNotExistsException
     */
    protected function handleArgs(array $args)
    {
        $argumentNumber = 1;

        foreach($this->arguments as $argument => $value) {
            if (!isset($args[$argumentNumber])) {
                throw new ArgumentNotExistsException("Argument [{$argument}] not found.");
            }

            $this->arguments[$argument] = $args[$argumentNumber];
            $argumentNumber++;
        }
    }
} 