<?php


namespace LaravelBatchFileCreator\Commands\Traits;


trait GetsPhpExecutableInformation
{
    public function getPhpExecutablePath() : string
    {
        return $this->option(config('batch.php.path_argument_name'));
    }
}