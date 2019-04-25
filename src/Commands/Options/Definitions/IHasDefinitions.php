<?php


namespace LaravelBatchFileCreator\Commands\Options\Definitions;


use LaravelBatchFileCreator\Commands\Options\Collection;

interface IHasDefinitions
{
    public function getDefinitions(): array;

    public function toCollection(): Collection;
}