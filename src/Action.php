<?php 

namespace Actionator;

use LogicException;
use InvalidArgumentException;
use Actionator\Result\ResultFailed;
use Actionator\Result\ResultSuccess;
use Actionator\Common\Implementations;
use Actionator\Format\FormatInterface;
use Actionator\Result\ResultInterface;

/**
 * Class Action
 *
 * Base Action class, which guarantee that action will execute once
 *
 * @package Actionator
 */
abstract class Action implements ActionInterface
{
    private $result;
    private bool $executed = false;

    /**
     * @see ActionInterface
     */
    final public function done(): bool
    {
        return $this->executed;
    }

    /**
     * @see ActionInterface
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
     * @see ActionInterface
     */
    final public function result($format = null)
    {
        if (!$this->executed) {
            throw new LogicException('Action has no result because it not yet been executed');
        }

        if (empty($format)) {
            return $this->result;
        }

        if (\is_callable($format)) {
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

    private function isFormatClass(?string $format): bool
    {
        $formatImpl = new Implementations($format);
        return $formatImpl->isImplement(FormatInterface::class);
    }

    /**
     * Returns by instruction method if action correct executed
     * 
     * @param  mixed $value
     * @return ResultInterface
     */
    protected function success($value): ResultInterface
    {
        return new ResultSuccess($value);
    }

    /**
     * Returns by instruction method if action no correct executed
     * 
     * @param  mixed $value
     * @return ResultInterface
     */
    protected function fail($value): ResultInterface
    {
        return new ResultFailed($value);
    }

    /**
     * Source code of action, which returns action result
     *
     * @return mixed
     */
    abstract protected function instruction(): ResultInterface;
}