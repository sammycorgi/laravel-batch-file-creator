<?php


namespace LaravelBatchFileCreator\Commands\Contracts;


interface IUsesPhpExecutable
{
    public function getPhpExecutablePath(): string;
}