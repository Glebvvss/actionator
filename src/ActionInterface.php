<?php

namespace Actionator;

/**
 * Interface ActionInterface
 *
 * Base Action contract
 *
 * @package Actionator
 */
interface ActionInterface
{
    /**
     * Start execution
     *
     * @return $this
     */
    public function execute(): self;

    /**
     * Check status action on done
     *
     * @return bool
     */
    public function done(): bool;

    /**
     * Fetch result of executed action
     *
     * @param string|callable|null $format
     * @return mixed
     */
    public function result($format = null);
}