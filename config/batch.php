<?php

return [
    'all' => [
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreatePhpArtisanServeBatchFile::class,
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreateOpenTerminalToProjectPathBatchFile::class,
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreateRunBatchFile::class,
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreateQueueWorkBatchFile::class,
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreateScheduleRunBatchFile::class,
        \Sammycorgi\LaravelBatchFileCreator\Commands\CreateNpmRunWatchBatchFile::class,
    ],
];