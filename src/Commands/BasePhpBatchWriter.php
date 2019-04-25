<?php

namespace Sammycorgi\LaravelBatchFileCreator\Commands;

use Sammycorgi\LaravelBatchFileCreator\Commands\Contracts\IUsesPhpExecutable;

abstract class BasePhpBatchWriter extends BaseBatchWriter implements IUsesPhpExecutable
{
    public function getPhpExecutableLocationSignatureArgument() : string
    {
        return "{--" . $this->getPhpPathArgumentName() . "={$this->getDefaultPhpPath()} : The full path of the php executable}";
    }

    public function getUserDefinedExecutablePath() : string
    {
        return $this->option($this->getPhpPathArgumentName());
    }

    public function getPhpPathArgumentName() : string
    {
        return 'php-path';
    }

    public function getDefaultPhpPath() : string
    {
        return "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "php.exe";
    }

    public function __construct()
    {
        parent::__construct();
    }
}