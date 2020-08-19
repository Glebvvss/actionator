<?php

namespace Actionator\Test\Format;

use PHPUnit\Framework\TestCase;
use Actionator\Format\FormatPipe;
use Actionator\Common\InstanceArgs;
use Actionator\Test\Stub\TestIntFormat;

class FormatPipeTest extends TestCase
{
    public function test_invoke_emptyFormatsProvided()
    {
        $pipe = new FormatPipe([]);
        $this->assertTrue($pipe(true));
    }

    public function test_invoke_withFormatCollection()
    {
        $pipe = new FormatPipe([
            TestIntFormat::class,
            function($result) {
                return [$result];
            }
        ]);
        $this->assertEquals([1], $pipe(true));
    }
}