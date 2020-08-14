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
     * Result of executed action. Can be prepared for client uses Format class name as first argument. 
     * Format class must implement Actionator\FormatInterface for correct working.
     * 
     * @return mixed
     */
    public function result(?string $format = '');
}