<?php


namespace LaravelBatchFileCreator\Commands;


use Illuminate\Console\Command;
use LaravelBatchFileCreator\Commands\Options\Definitions\IHasDefinitions;
use LaravelBatchFileCreator\Contracts\ICreatesBatchFiles;

abstract class BaseBatchWriter extends Command implements ICreatesBatchFiles
{
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() : void
    {
        file_put_contents($this->getFolderPath() . DIRECTORY_SEPARATOR . $this->getFileName(), $this->getContents());

        $this->info($this->getInfoMessage());
    }

    public function getFileName() : string
    {
        return $this->getCommandName() . "." . config('batch.file_extension');
    }

    public function getInfoMessage() : string
    {
        return $this->getFileName() . " batch file created successfully!";
    }

    public function getFolderPath(): string
    {
        $path = config('batch.folder_path');

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
        return config('batch.command_basename');
    }

    public function __construct()
    {
        $definitionName = config('batch.definitions.' . get_class($this));

        if(!blank($definitionName)) {
            $class = new $definitionName;

            if(!$class instanceof  IHasDefinitions) {
                throw new \Exception('Definitions are either not defined or do not implement the ' . IHasDefinitions::class . ' interface!');
            }

            $options = $class->toCollection()->__toString();
        } else {
            $options = "";
        }

        $this->signature = $this->getExecutableName() . ' ' . $options;

        parent::__construct();
    }

    public function appendContents(): string
    {
        $out = [];

        foreach($this->options() as $name => $value) {
            if(!$value) continue;

            foreach(config('batch.exclude_from_appends') as $toExclude) {
                if($name == config('batch.' . $toExclude)) {
                    continue 2;
                }
            }

            $out[] = "--$name=$value";
        }

        return implode(' ', $out);
    }
}