<?php

namespace Actionator\Test;

use LogicException;
use InvalidArgumentException;
use Actionator\ComplexAction;
use PHPUnit\Framework\TestCase;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Test\Stub\WithDepsAction;
use Actionator\Test\Stub\TestArrayFormat;
use Actionator\Test\Stub\TestIntFormat;

class ComlexActionTest extends TestCase
{
    public function test_execute_correct()
    {
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);

        $this->assertSame($complexAction, $complexAction->execute());
    }

    public function test_execute_doubbleExecuting()
    {
        $this->expectException(LogicException::class);
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $complexAction->execute();
        $complexAction->execute();
    }

    public function test_result_withoutFormatting()
    {
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $this->assertEquals(
            [true, true, true], 
            $complexAction->execute()->result()
        );
    }

    public function test_result_withClassFormat()
    {
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $this->assertEquals(
            [1, 1, 1], 
            $complexAction->execute()->result(TestIntFormat::class)
        );
    }

    public function test_result_withCallbackFormat()
    {
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $this->assertEquals(
            [1, 1, 1], 
            $complexAction->execute()->result(fn($result) => (int) $result)
        );
    }

    public function test_result_callResultBeforeExecute()
    {
        $this->expectException(LogicException::class);
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $complexAction->result();
    }

    public function test_result_withIncorrectFormatClass()
    {
        $this->expectException(InvalidArgumentException::class);
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $complexAction->execute()->result(NoDepsAction::class);
    }

    public function test_result_withNonExistingFormatClass()
    {
        $this->expectException(InvalidArgumentException::class);
        $complexAction = new ComplexAction([
            new NoDepsAction(),
            new NoDepsAction(),
            new NoDepsAction()
        ]);
        $complexAction->execute()->result('Not existiong format class');
    }
}