<?php 

/**
 * Action factory contract
 * 
 * Factory interface for make actions with their dependencies.
 * You can implement your own factories based of this interface.
 * Using actions with factories are not required, but allows you to make your code more testable.
 */
namespace Actionator\Factory;

use Actionator\ActionInterface;

/**
 * Interface ActionFactoryInterface
 *
 * Factory interface for make actions in your code
 * @package Actionator\Factory
 */
interface ActionFactoryInterface
{
    /**
     * Create new action.
     * 
     * @param string $className class name of action. Action class must extends from Actionator\Action base abstract class
     * @param array  $args      dependencies of action, which will provided in constructor of target action
     * @return ActionInterface
     */
    public function make(string $className, array $args = []): ActionInterface;
}