<?php

namespace Actionator\Test\Stub;

use Actionator\Action;
use Actionator\Exception\ActionException;

class ActionExceptionThrowsAction extends Action
{
    public function instruction()
    {
        throw new ActionException('Error message');
    }
}