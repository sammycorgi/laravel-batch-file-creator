<?php

namespace LaravelBatchFileCreator\Commands;

class CreateRunBatchFile extends BaseBatchWriter
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs the other batch files in the directory (this should be run last)';

    protected function getFiles()
    {
        return array_diff(scandir($this->getFolderPath()), ['.', '..']);
    }

    protected function getFilteredFiles()
    {
        return array_filter($this->getFiles(), function($item) {
            return preg_match('/\.bat/', $item) && $item !== $this->getFileName();
        });
    }

    protected function getMappedFileArray()
    {
        return array_map(function($item) {
            return "start " . $item;
        }, $this->getFilteredFiles());
    }

    public function getContents(): string
    {
        return implode(PHP_EOL, $this->getMappedFileArray());
    }

    public function getCommandName(): string
    {
        return "run";
    }
}
