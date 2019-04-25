<?php


namespace LaravelBatchFileCreator\Commands\Options;


use Symfony\Component\Console\Input\InputOption;

class OptionFactory
{
    public static function make($name, $default = null, $description = null)
    {
        $mode = $default === null ? 1 : 2;

        return new InputOption($name, null, $mode, $description, $default);
    }
}