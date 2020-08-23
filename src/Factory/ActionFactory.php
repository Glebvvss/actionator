<?php

namespace Actionator\Factory;

use ReflectionClass;
use Actionator\ActionInterface;
use Actionator\Common\InstanceArgs;

/**
 * Class ActionFactory
 *
 * Simple implementation of Actionator\Factory\ActionFactoryInterface
 *
 * @package Actionator\Factory
 */
class ActionFactory implements ActionFactoryInterface
{
    /**
     * @see ActionFactoryInterface
     */
    final public function make(string $className, array $args = []): ActionInterface
    {
        $instanceArgs = new InstanceArgs($className, $args);
        return (new ReflectionClass($className))->newInstanceArgs($instanceArgs->array());
    }
}