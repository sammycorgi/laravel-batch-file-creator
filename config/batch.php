<?php

return [
    'to_write' => [
        LaravelBatchFileCreator\Commands\CreatePhpArtisanServeBatchFile::class,
        LaravelBatchFileCreator\Commands\CreateOpenTerminalToProjectPathBatchFile::class,
        LaravelBatchFileCreator\Commands\CreateQueueWorkBatchFile::class,
        LaravelBatchFileCreator\Commands\CreateScheduleRunBatchFile::class,
        LaravelBatchFileCreator\Commands\CreateNpmRunWatchBatchFile::class,

        LaravelBatchFileCreator\Commands\CreateRunBatchFile::class, //this needs to go last as it generates a batch file that runs all the other files
    ],

    'folder_path' => base_path('batch'),

    'command_basename' => 'batch-make',

    'file_extension' => 'bat',

    'php' => [
        'exe_path' => "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "php.exe",
        'path_argument_name' => 'php-path',
    ],

    'exclude_from_appends' => [ //use dot notation to access same array
        'php.path_argument_name',
    ],

    'definitions' => [
        LaravelBatchFileCreator\Commands\CreatePhpArtisanServeBatchFile::class => \LaravelBatchFileCreator\Commands\Options\Definitions\ServeDefinitions::class,
        LaravelBatchFileCreator\Commands\CreateOpenTerminalToProjectPathBatchFile::class => null,
        LaravelBatchFileCreator\Commands\CreateRunBatchFile::class => null,
        LaravelBatchFileCreator\Commands\CreateQueueWorkBatchFile::class => \LaravelBatchFileCreator\Commands\Options\Definitions\QueueWorkDefinitions::class,
        LaravelBatchFileCreator\Commands\CreateScheduleRunBatchFile::class => \LaravelBatchFileCreator\Commands\Options\Definitions\ScheduleRunDefinitions::class,
        LaravelBatchFileCreator\Commands\CreateNpmRunWatchBatchFile::class => null,
    ]
];