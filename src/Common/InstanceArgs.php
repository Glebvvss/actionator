<?php 

namespace Actionator\Common;

use ReflectionClass;

class InstanceArgs
{
    private string $className;

    private array $args;

    public function __construct(string $className, array $args = [])
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Class name {$className} is no exists");
        }

        $this->className = $className;
        $this->args = $args;
    }

    public function array(): array
    {
        if (empty($this->args)) {
            return $this->args;
        }

        if ($this->hasNoAssocArgs()) {
            return $this->args;
        }

        return $this->arraySortedByTargetConstructor();
    }

    private function hasNoAssocArgs(): bool
    {
        return array_keys($this->args) === range(0, count($this->args) - 1);
    }

    private function arraySortedByTargetConstructor(): array
    {
        $result = [];
        $class = new ReflectionClass($this->className);
        $constructor = $class->getConstructor();
        foreach($constructor->getParameters() as $parameter) {
            if (!isset($this->args[$parameter->getName()])) {
                throw new InvalidArgumentException("Incorrect sugnature of {$className} class");
            }

            $result[] = $this->args[$parameter->getName()];
        }

        return $result;
    }
}