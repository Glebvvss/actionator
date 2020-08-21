<?php

require_once __DIR__ . '/vendor/autoload.php';

class DoubleAction extends \Actionator\Action
{
    private float $number;

    public function __construct(float $number)
    {
        $this->number = $number;
    }

    public function instruction()
    {
        return $this->number * 2;
    }
}

class RoundFormat extends \Actionator\Format\FormatInterface
{
    private float $result;

    public function __construct(float $result)
    {
        $this->result = $result;
    }

    public function formattedResult()
    {
        return round($this->result);
    }
}

$actionFactory = new \Actionator\Factory\ActionFactory();
$doubleAction = $actionFactory->make(DoubleAction::class, ['number' => 2.1]);

$doubleAction->done(); // returns false
$doubleAction->execute(); // if called more then one throws LogicException
$doubleAction->done(); // returns true

$result = $doubleAction->result(); // if called before execute throws LogicException
print $result; // 4.2

$result = $doubleAction->result(fn($result) => round($result)); // result with callback formatter
print $result; // 4

$result = $doubleAction->result(RoundFormat::class); // result with class formatter
print $result; // 4