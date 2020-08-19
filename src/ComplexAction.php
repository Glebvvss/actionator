<?php

namespace Actionator;

use LogicException;
use Actionator\Format\FormatInterface;

/**
 * Class which using for group actions single single complex atomic command
 */
final class ComplexAction implements ActionInterface
{
    private bool $executed = false;
    private array $actions;

    public function __construct(array $actions)
    {
        foreach($actions as $action) {
            if ($action->done()) {
                throw new LogicException('All provided actions must not be executed');
            }
        }

        $this->actions = $actions;
    }

    /**
     * @inheritdoc
     */
    public function execute(): self
    {
        if ($this->executed) {
            throw new LogicException('Action cannot be executed more then once');
        }

        foreach($this->actions as $action) {
            $action->execute();
        }

        $this->executed = true;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function done(): bool
    {
        return $this->executed;
    }

    /**
     * @inheritdoc
     */
    public function result($format = null): array
    {
        return array_map(fn($action) => $action->result($format), $this->actions);
    }
}