<?php 

/**
 * Abstract Action
 * 
 * Base class for your own actions, which garantee that action will be executed once.
 * For build your own actions you should extends this abstract class and implement code 
 * of your action in instionction abstract method
 */
namespace Actionator;

use is_callable;
use LogicException;
use InvalidArgumentException;
use Actionator\Common\Implementations;
use Actionator\Format\FormatInterface;

/**
 * Class Action
 *
 * Single atomic action (realizaton of "command" GoF pattern), which can be executed once and store inside yourself result of operation
 * @package Actionator
 */
abstract class Action implements ActionInterface
{
    /**
     * Result of executed action
     * 
     * @var mixed
     */
    private $result;

    /**
     * Action executed identifier
     * 
     * @var bool
     */
    private $executed = false;

    /**
     * Returns true if action already executed
     * 
     * @return bool
     */
    final public function done(): bool
    {
        return $this->executed;
    }

    /**
     * Execute action
     * 
     * @throws LogicException
     * @return self
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
     * Result of executed action. Can be prepared for client uses Format class name as first argument. 
     * Format class must implement Actionator\Format\FormatInterface for correct working
     * 
     * @param string|null|callback $format - format class name for prepare action result 
     * @throws LogicException
     * @throws InvalidArgumentException
     * @return mixed result of action
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

    /**
     * Returns true if provided format class implements Actionator\Format\FormatInterface
     * 
     * @param string $format format class name
     * @return bool
     */
    private function isFormatClass(string $format): bool
    {
        $formatImpl = new Implementations($format);
        return $formatImpl->isImplement(FormatInterface::class);
    }

    /**
     * Source code of action, which can be executed. Returns result of operation if needed.
     * 
     * @return mixed
     */
    abstract protected function instruction();
}