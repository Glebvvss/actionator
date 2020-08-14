<?php

namespace Actionator\Test\Factory;

use Actionator\Factory\Factory;
use PHPUnit\Framework\TestCase;
use Actionator\Test\Mock\NoDepsAction;
use Actionator\Test\Mock\WithDepsAction;

class ActionFactoryTest extends TestCase
{
    public function test_create_testingActionWithoutDependencies()
    {
        $factory = new Factory();
        $testAction = $factory->make(NoDepsAction::class);
        $this->assertEquals(new NoDepsAction, $testAction);
    }

    public function test_create_testingActionWithDependencies()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $factory = new Factory();
        $testAction = $factory->make(WithDepsAction::class, [$name, $lastName]);
        $this->assertEquals(new WithDepsAction($name, $lastName), $testAction);
    }

    public function test_create_testingActionWithDependenciesAssoc()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $factory = new Factory();
        $testAction = $factory->make(WithDepsAction::class, [
            'lastName' => $lastName,
            'name' => $name
        ]);

        $this->assertEquals(new WithDepsAction($name, $lastName), $testAction);
    }
}