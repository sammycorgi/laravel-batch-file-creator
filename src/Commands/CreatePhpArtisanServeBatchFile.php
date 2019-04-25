<?php

namespace Sammycorgi\LaravelBatchFileCreator\Commands;

class CreatePhpArtisanServeBatchFile extends BasePhpBatchWriter
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs php artisan serve for the laravel project';

    public function getContents(): string
    {
        return "cd " . base_path() . PHP_EOL . "{$this->getUserDefinedExecutablePath()} artisan serve {$this->getHostnameString()} {$this->getPortString()}";
    }

    protected function getPortString()
    {
        return is_null($this->getPort()) ? null : '--port=' . $this->getPort();
    }

    protected function getHostnameString()
    {
        return is_null($this->getHostname()) ? null : '--host=' . $this->getHostname();
    }

    protected function getHostname() : ?string
    {
        return $this->option('hostname');
    }

    protected function getPort() : ?string
    {
        return $this->option('port');
    }

    public function getCommandName(): string
    {
        return "serve-local-dev-server";
    }

    public function getCustomOptions() : ?string
    {
        return "{--hostname=localhost} {--port=8000} " . $this->getPhpExecutableLocationSignatureArgument();
    }
}
