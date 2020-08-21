<?php

/**
 * Pipeline handler, which apply encapsulated formats
 */
namespace Actionator\Format;

use is_callable;

/**
 * Class FormatPipe
 *
 * Pipeline handler, which apply encapsulated formats
 *
 * @package Actionator\Format
 */
final class FormatPipe
{
	/**
	 * Collection of stored formats
	 *
	 * @var array
	 */
    private $formats;

    /**
     * Constructor of class
     * 
     * @param array $formats list of format preparers
     */
    public function __construct(array $formats)
    {
        $this->formats = $formats;
    }

    /**
     * Method for running format pipeline
     * 
     * @param  mixed $result result of action
     * @return mixed prepared by format handlers action result
     */
    public function __invoke($result)
    {
        return array_reduce($this->formats, function($result, $format) {
            if (is_callable($format)) {
                return $format($result);
            }
            return (new $format($result))->formattedResult();
        }, $result);
    }
}