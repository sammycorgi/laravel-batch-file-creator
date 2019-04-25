<?php


namespace LaravelBatchFileCreator\Commands\Options;


class CollectionFactory
{
    public static function make(array $options = [])
    {
        return new Collection($options);
    }
}