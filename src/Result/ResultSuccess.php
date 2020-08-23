<?php

namespace Actionator\Result;

class ResultSuccess implements ResultInterface
{
    private $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function success(): bool
    {
        return true;
    }

    public function value()
    {
        return $this->result;
    }
}