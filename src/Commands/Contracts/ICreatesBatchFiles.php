<?php

namespace Sammycorgi\LaravelBatchFileCreator\Contracts;

interface ICreatesBatchFiles
{
    public function getContents(): string;

    public function getInfoMessage(): string;

    public function getFileName(): string;

    public function getFolderName(): string;

    public function getFolderPath(): string;

    public function getExecutableName(): string;

    public function getCommandName(): string;

    public function getCustomOptions(): ?string;

    public function handle(): void;
}