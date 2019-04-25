<?php

namespace Sammycorgi\LaravelBatchFileCreator\Commands;

class CreateOpenTerminalToProjectPathBatchFile extends BaseBatchWriter
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that opens the terminal the the laravel project directory';

    public function getContents(): string
    {
        return "cd " . base_path() . PHP_EOL . "cmd \\k";
    }

    public function getCommandName(): string
    {
        return "open-terminal";
    }

    public function getCustomOptions(): ?string
    {
        return null;
    }
}
