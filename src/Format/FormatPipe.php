<?php

namespace Actionator\Format;

use is_callable;

/**
 * Class FormatPipe
 *
 * Format class, which chains apply collection of other format classes
 *
 * @package Actionator\Format
 */
final class FormatPipe
{
    private array $formats;

    /**
     * FormatPipe constructor.
     *
     * @param array $formats
     */
    public function __construct(array $formats)
    {
        $this->formats = $formats;
    }

    /**
     * Start format pipe
     *
     * @param  mixed $result
     * @return mixed
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