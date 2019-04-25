<?php

namespace LaravelBatchFileCreator\Commands;

class CreateNpmRunWatchBatchFile extends BaseBatchWriter
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs npm run watch for the project';

    public function getContents() : string
    {
        return "cd " . base_path() . PHP_EOL . "npm run watch";
    }

    public function getCommandName(): string
    {
        return "run-watch";
    }
}
