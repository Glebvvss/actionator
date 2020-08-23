<?php

namespace Actionator;

use LogicException;

/**
 * Class ComplexAction
 *
 * Group collection of simple actions in grouped action, which can be executed like single action
 *
 * @package Actionator
 */
final class ComplexAction implements ActionInterface
{
    private bool  $executed = false;
    private array $actions;

    /**
     * ComplexAction constructor
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
     * @see ActionInterface
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
     * @see ActionInterface
     */
    public function done(): bool
    {
        return $this->executed;
    }

    /**
     * @see ActionInterface
     */
    public function result($format = null): array
    {
        return array_map(
            fn($action) => $action->result($format), 
            $this->actions
        );
    }
}