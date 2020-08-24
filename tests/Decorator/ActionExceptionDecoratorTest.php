<?php

namespace Actionstor\Test\Decorator;

use Actionator\Common\Error;
use PHPUnit\Framework\TestCase;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Decorator\ActionExceptionDecorator;
use Actionator\Test\Stub\ActionExceptionThrowsAction;

class ActionExceptionDecoratorTest extends TestCase
{
    public function test_result_successResult()
    {
        $action = new ActionExceptionDecorator(
            new NoDepsAction()
        );

        $this->assertTrue($action->execute()->result());
    }

    public function test_result_catchError()
    {
        $action = new ActionExceptionDecorator(
            new ActionExceptionThrowsAction()
        );

        $this->assertEquals(
            new Error('Error message'),
            $action->execute()->result()
        );
    }

    public function test_done_returnsTrue()
    {
        $action = new ActionExceptionDecorator(
            new NoDepsAction()
        );

        $action->execute();

        $this->assertTrue($action->done());
    }

    public function test_done_returnsFalse()
    {
        $action = new ActionExceptionDecorator(
            new ActionExceptionThrowsAction()
        );

        $this->assertFalse($action->done());
    }
}