<?php 

namespace Actionator\Common;

use InvalidArgumentException;

class Implementations
{
    private string $className;

    public function __construct(string $className)
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Class {$className} not exists");
        }

        $this->className = $className;
    }

    public function isImplement(string $interfaceName)
    {
        return in_array($interfaceName, $this->array());
    }

    public function array(): array
    {
        return array_values(class_implements($this->className));
    }
}