<?php


namespace LaravelBatchFileCreator\Commands\Options;

use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputOption;

class Collection
{
    protected $options;

    /**
     * Collection constructor.
     * @param null $options
     * @throws \Exception
     */
    public function __construct($options = null)
    {
        $this->options = Arr::wrap($options);

        foreach($options as $option) {
            if(!$option instanceof InputOption) {
                throw new \Exception('Options must be of class ' . InputOption::class);
            }
        }
    }

    protected function optionToString(InputOption $option) : string
    {
        $name = "--{$option->getName()}";

        $appends = $option->isValueRequired() ? "={$option->getDefault()}" : "";

        return "{" . $name . $appends . "}";
    }

    protected function stringArray() : array
    {
        $out = [];

        foreach($this->options as $option) {
            $out[] = $this->optionToString($option);
        }

        return $out;
    }

    public function __toString() : string
    {
        return implode(' ', $this->stringArray());
    }
}