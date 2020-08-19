<?php 

namespace Actionator\Format;

use is_callable;
use InvalidArgumentException;

/**
 * Format Pipeline class, which walks through the list of formats and applies them in turn
 */
final class FormatPipe
{
    private array $formats;

    public function __construct(array $formats)
    {
        $this->formats = $formats;
    }

    /**
     * Method for running format pipeline
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