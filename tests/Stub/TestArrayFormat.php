<?php 

namespace Actionator\Test\Stub;

use Actionator\Format\FormatInterface;

class TestArrayFormat implements FormatInterface
{
    private $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function formattedResult()
    {
        return (array) $this->result;
    }
}