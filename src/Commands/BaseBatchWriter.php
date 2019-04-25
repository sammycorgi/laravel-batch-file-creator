<?php


namespace Sammycorgi\LaravelBatchFileCreator\Commands;


use Illuminate\Console\Command;
use Sammycorgi\LaravelBatchFileCreator\Contracts\ICreatesBatchFiles;

abstract class BaseBatchWriter extends Command implements ICreatesBatchFiles
{
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() : void
    {
        file_put_contents(base_path($this->getFolderName() . DIRECTORY_SEPARATOR . $this->getFileName()), $this->getContents());

        $this->info($this->getInfoMessage());
    }

    public function getFileName() : string
    {
        return $this->getCommandName() . ".bat";
    }

    public function getInfoMessage() : string
    {
        return $this->getFileName() . " batch file created successfully!";
    }

    public function getFolderName() : string
    {
        return "batch";
    }

    public function getFolderPath(): string
    {
        $path = base_path($this->getFolderName());

        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    public function getExecutableName(): string
    {
        return $this->getCommandBaseName() . ':' . $this->getCommandName();
    }

    public function getCommandBaseName()
    {
        return "batch-make";
    }

    public function __construct()
    {
        $this->signature = $this->getExecutableName() . ' ' . $this->getCustomOptions();

        parent::__construct();
    }
}