<?php 

namespace Actionator\Error;

/**
 * Simple action error implementation
 */
class Error implements ErrorInterface
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @see ErrorInterface
     */
    public function toArray(): array
    {
        return ['error' => $this->message];
    }
}