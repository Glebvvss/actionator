<?php

namespace Actionator\Decorator;

use Actionator\Common\Error;
use Actionator\ActionInterface;
use Actionator\Exception\ActionException;

/**
 * Decorator, which catch Action\Exception\ActionException and save throws message
 */
class ActionExceptionDecorator implements ActionInterface
{
    private ?Error $error;
    private ActionInterface $action;

    /**
     * @param ActionInterface $action
     */
    public function __construct(ActionInterface $action)
    {
        $this->action = $action;
    }

    /**
     * @see ActionInterface
     */
    public function done(): bool
    {
        return $this->action->done();
    }

    /**
     * @see ActionInterface
     */
    public function execute(): self
    {
        try {
            $this->action->execute();
        } catch(ActionException $ex) {
            $this->error = new Error($ex->getMessage());
        }

        return $this;
    }

    /**
     * @see ActionInterface
     */
    public function result($format = null)
    {
        if (empty($this->error)) {
            return $this->action->result($format);
        }

        if (empty($format)) {
            return $this->error;
        }

        if (\is_callable($format)) {
            return $format($this->error);
        }

        $formatInstance = new $format($this->error);
        return $formatInstance->formattedResult();
    }
}