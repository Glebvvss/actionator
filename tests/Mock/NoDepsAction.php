<?php 

namespace Actionator\Test\Mock;

use Actionator\Action;

class NoDepsAction extends Action
{
    protected function instruction()
    {
        return true;
    }
}