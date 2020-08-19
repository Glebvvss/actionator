<?php

namespace Actionator\Test\Common;

use PHPUnit\Framework\TestCase;
use Actionator\Common\InstanceArgs;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Test\Stub\WithDepsAction;

class InstanceArgsTest extends TestCase
{
    public function test_array_instanceWithoutArgs()
    {
        $instanceArgs = new InstanceArgs(NoDepsAction::class, []);
        $this->assertEquals([], $instanceArgs->array());
    }

    public function test_array_instanceSimpleArgsArray()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $instanceArgs = new InstanceArgs(WithDepsAction::class, [$name, $lastName]);
        $this->assertEquals([$name, $lastName], $instanceArgs->array());
    }

    public function test_array_instanceArgsAssocArgsArray()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $instanceArgs = new InstanceArgs(WithDepsAction::class, [
            'lastName' => $lastName,
            'name' => $name
        ]);

        $this->assertEquals([$name, $lastName], $instanceArgs->array());
    }
}