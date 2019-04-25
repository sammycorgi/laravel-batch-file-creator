<?php

namespace LaravelBatchFileCreator;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelBatchFileCreator\Commands\CreateBatchFiles;
use LaravelBatchFileCreator\Commands\CreateNpmRunWatchBatchFile;
use LaravelBatchFileCreator\Commands\CreateOpenTerminalToProjectPathBatchFile;
use LaravelBatchFileCreator\Commands\CreatePhpArtisanServeBatchFile;
use LaravelBatchFileCreator\Commands\CreateQueueWorkBatchFile;
use LaravelBatchFileCreator\Commands\CreateRunBatchFile;
use LaravelBatchFileCreator\Commands\CreateScheduleRunBatchFile;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                CreateBatchFiles::class,
                CreateNpmRunWatchBatchFile::class,
                CreateOpenTerminalToProjectPathBatchFile::class,
                CreatePhpArtisanServeBatchFile::class,
                CreateQueueWorkBatchFile::class,
                CreateScheduleRunBatchFile::class,
                CreateRunBatchFile::class,
            ]);
        }

        $this->publishes([__DIR__ . '/../config/batch.php' => config_path('batch.php')], 'config');
    }

    public function register()
    {
        if($this->app->config->get('batch') === null) {
            $this->app->config->set('batch', require(__DIR__ . '/../config/batch.php'));
        }
    }
}