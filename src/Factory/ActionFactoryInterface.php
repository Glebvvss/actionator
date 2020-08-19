<?php 

namespace Actionator\Factory;

use Actionator\ActionInterface;

/**
 * Factory interface for make actions in your code.
 */
interface ActionFactoryInterface
{
    /**
     * Create new action.
     * 
     * @param string $className - class name of action. Action class must extends from Actionator\Action base abstract class
     * @param array $args - dependencies of action, which will provided in constructor of target action
     * @return Action
     */
    public function make(string $className, array $args = []): ActionInterface;
}