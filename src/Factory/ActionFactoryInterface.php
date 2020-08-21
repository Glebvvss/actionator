<?php 

namespace Actionator\Factory;

use Actionator\ActionInterface;

/**
 * Interface ActionFactoryInterface
 *
 * Base ActionFactory contract for classes, which can creating action instances
 *
 * @package Actionator\Factory
 */
interface ActionFactoryInterface
{
    /**
     * Create new action instance
     *
     * @param  string $className
     * @param  array $args
     * @return ActionInterface
     */
    public function make(string $className, array $args = []): ActionInterface;
}