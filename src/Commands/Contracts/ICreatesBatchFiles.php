<?php

namespace LaravelBatchFileCreator\Contracts;

use LaravelBatchFileCreator\Commands\Options\Collection;

interface ICreatesBatchFiles
{
    public function getContents(): string;

    public function getInfoMessage(): string;

    public function getFileName(): string;

    public function getFolderPath(): string;

    public function getExecutableName(): string;

    public function getCommandName(): string;

    public function handle(): void;
}