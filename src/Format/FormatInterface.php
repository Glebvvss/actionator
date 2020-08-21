<?php 

namespace Actionator\Format;

/**
 * Interface FormatInterface
 *
 * Base Format Contract for classes, which uses to prepare results of actions
 *
 * @package Actionator\Format
 */
interface FormatInterface
{
    /**
     * Returns prepared action result
     *
     * @return mixed
     */
    public function formattedResult();
}