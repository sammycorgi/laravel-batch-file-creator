<?php


namespace LaravelBatchFileCreator\Commands\Options\Definitions;


class QueueWorkDefinitions extends Definition
{
    public function getDefinitions(): array
    {
        return [
            [
                'name' => config('batch.php.path_argument_name'),
                'default' => config('batch.php.exe_path'),
            ],

            [
                'name' => 'queue',
                'default' => 'default',
            ],

            [
                'name' => 'sleep',
                'default' => 3,
            ],

            [
                'name' => 'timeout',
                'default' => 60,
            ],

            [
                'name' => 'tries',
                'default' => 0,
            ]
        ];
    }
}