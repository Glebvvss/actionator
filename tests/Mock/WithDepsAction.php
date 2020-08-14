<?php 

namespace Actionator\Test\Mock;

use stdClass;
use Actionator\Action;

class WithDepsAction extends Action
{
    private string $name;

    private string $lastName;

    public function __construct(string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
    }

    protected function instruction()
    {
        $result = new stdClass();
        $result->name = $this->name;
        $result->lastName = $this->lastName;
        return $result;
    }
}