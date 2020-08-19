<?php 

namespace Actionator\Test\Stub;

use Actionator\Action;

class NoDepsAction extends Action
{
    protected function instruction()
    {
        return true;
    }
}