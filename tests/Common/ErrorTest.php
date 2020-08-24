<?php

namespace Actionator\Test\Common;

use Actionator\Common\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{
    public function test_toArray()
    {
        $error = new Error('Error Message');
        $this->assertEquals(
            ['error' => 'Error Message'],
            $error->toArray()
        );
    }
}