<?php

namespace Sammycorgi\LaravelBatchFileCreator\Commands;

class CreateQueueWorkBatchFile extends BasePhpBatchWriter
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch-make:queue-work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs queue:work for the laravel project';

    public function getContents(): string
    {
        return "cd " . base_path() . PHP_EOL . "{$this->getUserDefinedExecutablePath()} artisan queue:work";
    }

    public function getCustomOptions() : string
    {
        return $this->getPhpExecutableLocationSignatureArgument();
    }

    public function getCommandName(): string
    {
        return "queue-work";
    }
}
