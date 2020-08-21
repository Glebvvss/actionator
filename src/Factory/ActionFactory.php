<?php

/**
 * Simple Action Factory
 * 
 * Simple default implementation of Actionator\ActionFactoryInterface for creating your own actions
 */
namespace Actionator\Factory;

use ReflectionClass;
use ReflectionException;
use Actionator\ActionInterface;
use Actionator\Common\InstanceArgs;

/**
 * Class ActionFactory
 *
 * Simple action factory implementation
 * @package Actionator\Factory
 */
class ActionFactory implements ActionFactoryInterface
{
    /**
     * Create new action
     *
     * @param  string $className
     * @param  array  $args
     * @return ActionInterface
     * @throws ReflectionException
     */
    final public function make(string $className, array $args = []): ActionInterface
    {
        $instanceArgs = new InstanceArgs($className, $args);
        return (new ReflectionClass($className))->newInstanceArgs($instanceArgs->array());
    }
}