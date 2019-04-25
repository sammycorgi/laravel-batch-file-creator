<?php


namespace LaravelBatchFileCreator\Commands\Options\Definitions;


class ScheduleRunDefinitions extends Definition
{

    public function getDefinitions(): array
    {
        return [
            [
                'name' => config('batch.php.path_argument_name'),
                'default' => config('batch.php.exe_path'),
            ],
        ];
    }
}