<?php


namespace LaravelBatchFileCreator\Commands\Options\Definitions;


use LaravelBatchFileCreator\Commands\Options\Collection;
use LaravelBatchFileCreator\Commands\Options\CollectionFactory;
use LaravelBatchFileCreator\Commands\Options\OptionFactory;

abstract class Definition implements IHasDefinitions
{
    public function toCollection() : Collection
    {
        $collection = [];

        foreach($this->getDefinitions() as $item) {
            $collection[] = OptionFactory::make(
                $this->getValue($item, 'name', ''),
                $this->getValue($item, 'default', null),
                $this->getValue($item, 'description', '')
            );
        }

        return CollectionFactory::make($collection);
    }

    protected function getValue($item, $attribute, $returnValue)
    {
        return isset($item[$attribute]) ? $item[$attribute] : $returnValue;
    }
}