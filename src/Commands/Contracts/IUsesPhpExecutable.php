<?php


namespace Sammycorgi\LaravelBatchFileCreator\Commands\Contracts;


interface IUsesPhpExecutable
{
    public function getPhpPathArgumentName(): string;

    public function getDefaultPhpPath(): string;

    public function getUserDefinedExecutablePath(): string;

    public function getPhpExecutableLocationSignatureArgument(): string;
}