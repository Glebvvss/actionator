<?php

namespace Actionator\Result;

interface ResultInterface
{
    public function success(): bool;

    public function value();
}