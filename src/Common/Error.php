<?php 

namespace Actionator\Common;

class Error
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function toArray(): array
    {
        return ['error' => $this->message];
    }
}