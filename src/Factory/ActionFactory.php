<?php

namespace Actionator\Factory;

use ReflectionClass;
use Actionator\ActionInterface;
use Actionator\Common\InstanceArgs;

/**
 * Simple implementation of action factory
 */
class ActionFactory implements ActionFactoryInterface
{
    /**
     * @inheritdoc
     */
    final public function make(string $className, array $args = []): ActionInterface
    {
        $instanceArgs = new InstanceArgs($className, $args);
        return (new ReflectionClass($className))->newInstanceArgs($instanceArgs->array());
    }
}