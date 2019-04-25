<?php

namespace LaravelBatchFileCreator\Commands;

use LaravelBatchFileCreator\Commands\Traits\GetsPhpExecutableInformation;

class CreateQueueWorkBatchFile extends BaseBatchWriter
{
    use GetsPhpExecutableInformation;

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
        return "cd " . base_path() . PHP_EOL . $this->getPhpExecutablePath() . " artisan queue:work {$this->appendContents()}";
    }

    public function getCommandName(): string
    {
        return "queue-work";
    }
}
