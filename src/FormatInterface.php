<?php 

namespace Actionator;

/**
 * Format interface for prepare result of actions
 */
interface FormatInterface
{
    /**
     * Method for prepare result format of action
     * 
     * @return mixed
     */
    public function formattedResult();
}