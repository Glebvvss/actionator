<?php 

namespace Actionator\Error;

/**
 * Base action error contract
 */
interface ErrorInterface
{
    /**
     * Transform error to array
     * 
     * @return array
     */
    public function toArray(): array;
}