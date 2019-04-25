<?php


namespace LaravelBatchFileCreator\Commands\Options\Definitions;


class ServeDefinitions extends Definition
{
    public function getDefinitions(): array
    {
        return [
            [
                'name' => 'host',
                'default' => 'localhost',
            ],

            [
                'name' => 'port',
                'default' => 8000,
            ],

            [
                'name' => config('batch.php.path_argument_name'),
                'default' => config('batch.php.exe_path'),
            ],
        ];
    }
}