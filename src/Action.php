<?php 

namespace Actionator;

use is_callable;
use LogicException;
use InvalidArgumentException;
use Actionator\Common\Implementations;
use Actionator\Format\FormatInterface;

/**
 * Single atomic action (realizaton of "command" GoF pattern), which can be executed once and store inside yourself result of operation
 */
abstract class Action implements ActionInterface
{
    private $result;

    private bool $executed = false;

    /**
     * @inheritdoc
     */
    final public function done(): bool
    {
        return $this->executed;
    }

    /**
     * @inheritdoc
     * 
     * @throws LogicException
     */
    final public function execute(): self
    {
        if ($this->executed) {
            throw new LogicException('Action cannot be executed more then once');
        }

        $this->result = $this->instruction();
        $this->executed = true;
        return $this;
    }

    /**
     * @inheritdoc
     * 
     * @param string|null|callback $format - format class name for prepare action result 
     * @throws LogicException
     * @throws InvalidArgumentException
     * @return mixed
     */
    final public function result($format = null)
    {
        if (!$this->executed) {
            throw new LogicException('Action has no result because it not yet been executed');
        }

        if (empty($format)) {
            return $this->result;
        }

        if (is_callable($format)) {
            return $format($this->result);
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

    /**
     * Source code of action, which can be executed. Return result of operation if needed.
     * 
     * @return mixed
     */
    abstract protected function instruction();
}