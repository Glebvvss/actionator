<?php

/**
 * Complex Action
 * 
 * Sometimes you want to use collection of actions like an sindle atomic action.
 * Complex action is simple implementation for this.
 */
namespace Actionator;

use LogicException;

/**
 * Class ComplexAction
 *
 * Uses for group actions single single complex atomic command
 * @package Actionator
 */
final class ComplexAction implements ActionInterface
{
    /**
     * Action executed identifier
     * 
     * @var bool
     */
    private $executed = false;

    /**
     * Collection of stored actions
     * 
     * @var array
     */
    private $actions;

    /**
     * ComplexAction constructor.
     *
     * @param array $actions
     */
    public function __construct(array $actions)
    {
        foreach($actions as $action) {
            if ($action->done()) {
                throw new LogicException('All provided actions must not be executed');
            }
        }

        $this->actions = $actions;
    }

    /**
     * Execute all encapsulated actions
     *
     * @return $this
     */
    public function execute(): self
    {
        if ($this->executed) {
            throw new LogicException('Action cannot be executed more then once');
        }

        foreach($this->actions as $action) {
            $action->execute();
        }

        $this->executed = true;
        return $this;
    }

    /**
     * Returns true if action already executed
     * 
     * @return bool
     */
    public function done(): bool
    {
        return $this->executed;
    }

    /**
     * Result of executed action. Can be prepared for client uses Format class name as first argument. 
     * Format class must implement Actionator\Format\FormatInterface for correct working.
     *
     * @param string|callable $format
     * @return array
     */
    public function result($format = null): array
    {
        return array_map(function($action) use ($format) {
            return $action->result($format);
        }, $this->actions);
    }
}