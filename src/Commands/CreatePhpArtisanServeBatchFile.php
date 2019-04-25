<?php

namespace LaravelBatchFileCreator\Commands;

use LaravelBatchFileCreator\Commands\Traits\GetsPhpExecutableInformation;

class CreatePhpArtisanServeBatchFile extends BaseBatchWriter
{
    use GetsPhpExecutableInformation;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a batch file that runs php artisan serve for the laravel project';

    public function getContents(): string
    {
        return "cd " . base_path() . PHP_EOL . $this->getPhpExecutablePath() . " artisan serve {$this->appendContents()}";
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
        return $this->option('host');
    }

    protected function getPort() : ?string
    {
        return $this->option('port');
    }

    public function getCommandName(): string
    {
        return "serve-local-dev-server";
    }
}
