<?php

namespace Actionator\Result;

class ResultFailed implements ResultInterface
{
    private $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function success(): bool
    {
        return false;
    }

    public function value()
    {
        return $this->result;
    }
}