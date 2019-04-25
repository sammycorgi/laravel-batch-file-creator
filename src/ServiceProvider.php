<?php

namespace Sammycorgi\LaravelBatchFileCreator;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateBatchFiles;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateNpmRunWatchBatchFile;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateOpenTerminalToProjectPathBatchFile;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreatePhpArtisanServeBatchFile;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateQueueWorkBatchFile;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateRunBatchFile;
use Sammycorgi\LaravelBatchFileCreator\Commands\CreateScheduleRunBatchFile;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->commands([
            CreateBatchFiles::class,
            CreateNpmRunWatchBatchFile::class,
            CreateOpenTerminalToProjectPathBatchFile::class,
            CreatePhpArtisanServeBatchFile::class,
            CreateQueueWorkBatchFile::class,
            CreateScheduleRunBatchFile::class,
            CreateRunBatchFile::class,
        ]);

        $this->publishes(['../config/batch.php' => config_path('batch.php')]);
    }

    public function register()
    {

    }
}