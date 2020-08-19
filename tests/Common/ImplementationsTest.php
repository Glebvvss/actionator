<?php

namespace Actionator\Test\Common;

use Actionator\Format\FormatInterface;
use PHPUnit\Framework\TestCase;
use Actionator\Common\Implementations;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Test\Stub\WithDepsAction;
use Actionator\Test\Stub\TestArrayFormat;
use Actionator\Test\Stub\SimpleTestClass;

class ImplementationsTest extends TestCase
{
    public function test_array_classWithoutInterfaceImplementations()
    {
        $implementations = new Implementations(SimpleTestClass::class);
        $this->assertEquals([], $implementations->array());
    }

    public function test_array_classWithInterfaceImplementations()
    {
        $implementations = new Implementations(TestArrayFormat::class);
        $this->assertEquals([FormatInterface::class], $implementations->array());
    }

    public function test_isImplement_success()
    {
        $implementations = new Implementations(TestArrayFormat::class);
        $this->assertTrue($implementations->isImplement(FormatInterface::class));
    }

    public function test_isImplement_noSuccess()
    {
        $implementations = new Implementations(NoDepsAction::class);
        $this->assertFalse($implementations->isImplement(FormatInterface::class));
    }
}