<?php

namespace Actionator\Test;

use LogicException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Actionator\Format\FormatPipe;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Test\Stub\TestIntFormat;
use Actionator\Test\Stub\WithDepsAction;
use Actionator\Test\Stub\TestArrayFormat;

class ActionTest extends TestCase
{
    public function test_execute_correct()
    {
        $action = new NoDepsAction();
        $this->assertSame($action, $action->execute());
    }

    public function test_execute_doubbleExecuting()
    {
        $this->expectException(LogicException::class);
        $action = new NoDepsAction();
        $action->execute();
        $action->execute();
    }

    public function test_result_withoutFormatting()
    {
        $action = new NoDepsAction();
        $this->assertTrue($action->execute()->result());
    }

    public function test_result_withClassFormat()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $action = new WithDepsAction($name, $lastName);
        $this->assertEquals(
            ['name' => $name, 'lastName' => $lastName],
            $action->execute()->result(TestArrayFormat::class)
        );
    }

    public function test_result_withCallbackFormat()
    {
        $name = 'John';
        $lastName = 'Mayer';

        $action = new WithDepsAction($name, $lastName);
        $this->assertEquals(
            ['name' => $name, 'lastName' => $lastName],
            $action->execute()->result(fn($result) => (array) $result)
        );
    }

    public function test_result_callResultBeforeExecute()
    {
        $this->expectException(LogicException::class);
        $action = new NoDepsAction();
        $action->result();
    }

    public function test_result_withIncorrectFormatClass()
    {
        $this->expectException(InvalidArgumentException::class);

        $name = 'John';
        $lastName = 'Mayer';

        $action = new WithDepsAction($name, $lastName);
        $action->execute()->result(NoDepsAction::class);
    }

    public function test_result_withNonExistingFormatClass()
    {
        $this->expectException(InvalidArgumentException::class);

        $name = 'John';
        $lastName = 'Mayer';

        $action = new WithDepsAction($name, $lastName);
        $action->execute()->result('Not existiong format class');
    }

    public function test_result_usingFormatPipeline()
    {
        $action = new NoDepsAction();
        $result = $action->execute()->result(new FormatPipe([
            TestIntFormat::class,
            function($result) {
                return [$result];
            }
        ]));

        $this->assertEquals([1], $result);
    }
}