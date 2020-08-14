<?php

namespace Actionator\Factory;

use ReflectionClass;
use Actionator\Action;
use Actionator\Common\InstanceArgs;

/**
 * Simple implementation of action factory
 */
class Factory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    final public function make(string $className, array $args = []): Action
    {
        $instanceArgs = new InstanceArgs($className, $args);
        return (new ReflectionClass($className))->newInstanceArgs($instanceArgs->array());
    }
}