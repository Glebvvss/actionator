<?php

namespace Actionstor\Test\Decorator;

use Actionator\Common\Error;
use PHPUnit\Framework\TestCase;
use Actionator\Decorator\ErrorCatch;
use Actionator\Test\Stub\NoDepsAction;
use Actionator\Test\Stub\ActionExceptionThrowsAction;

class ErrorCatchTest extends TestCase
{
    public function test_result_successResult()
    {
        $action = new ErrorCatch(
            new NoDepsAction()
        );

        $this->assertTrue($action->execute()->result());
    }

    public function test_result_catchError()
    {
        $action = new ErrorCatch(
            new ActionExceptionThrowsAction()
        );

        $this->assertEquals(
            new Error('Error message'),
            $action->execute()->result()
        );
    }

    public function test_done_returnsTrue()
    {
        $action = new ErrorCatch(
            new NoDepsAction()
        );

        $action->execute();

        $this->assertTrue($action->done());
    }

    public function test_done_returnsFalse()
    {
        $action = new ErrorCatch(
            new ActionExceptionThrowsAction()
        );

        $this->assertFalse($action->done());
    }
}