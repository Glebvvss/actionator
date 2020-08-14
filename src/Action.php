<?php 

namespace Actionator;

use LogicException;
use InvalidArgumentException;
use Actionator\Common\Implementations;

abstract class Action
{
    private $result;

    private bool $executed = false;

    final public function execute(): self
    {
        if ($this->executed) {
            throw new LogicException('Action cannot be executed more then once');
        }

        $this->result = $this->instruction();
        $this->executed = true;
        return $this;
    }

    final public function result(?string $format = '')
    {
        if (!$this->executed) {
            throw new LogicException('Action has no result because it not yet been executed');
        }

        if (empty($format)) {
            return $this->result;
        }

        if (!class_exists($format)) {
            throw new InvalidArgumentException("Class {$format} no exists");
        }
        
        if (!$this->isFormatClass($format)) {
            throw new InvalidArgumentException("Class {$format} must implement " . FormatInterface::class);
        }

        return (new $format($this->result))->formattedResult();
    }

    private function isFormatClass($format)
    {
        $formatImpl = new Implementations($format);
        return $formatImpl->isImplement(FormatInterface::class);
    }

    abstract protected function instruction();
}