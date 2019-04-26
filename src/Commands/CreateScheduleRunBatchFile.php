<?php

namespace LaravelBatchFileCreator\Commands;

class CreateScheduleRunBatchFile extends BaseBatchWriter
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs the schedule every minute for the laravel project';

    public function getContents(): string
    {
        return "ECHO off" . PHP_EOL . "SET pass=0" . PHP_EOL . ":loop" . PHP_EOL . "ECHO Schedule run %pass% times" .PHP_EOL  . "cd " . base_path() . PHP_EOL . config('batch.php.exe_path') . " artisan schedule:run" . PHP_EOL . "SET /A pass=pass+1" . PHP_EOL . "timeout /t 59" . PHP_EOL . "goto loop";
    }

    public function getCommandName() : string
    {
        return "schedule-run";
    }
}
