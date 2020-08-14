<?php 

namespace Actionator\Factory;

interface FactoryInterface
{
    public function make(string $className, array $args = []): object;
}