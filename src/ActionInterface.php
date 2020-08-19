<?php

namespace Actionator;

/**
 * Single atomic action (realizaton of "command" GoF pattern)
 */
interface ActionInterface
{
    /**
     * Execute action
     * 
     * @return self
     */
    public function execute(): self;

    /**
     * Returns true if action already executed
     * 
     * @return bool
     */
    public function done(): bool;

    /**
     * Result of executed action. Can be prepared for client uses Format class name as first argument. 
     * Format class must implement Actionator\Format\FormatInterface for correct working.
     * @return mixed
     */
    public function result($format = null);
}