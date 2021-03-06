<?php

namespace LaravelBatchFileCreator\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CreateBatchFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch-make:all {--defaults}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used for creating batch files for easier developing of laravel in windows environments';

    protected $phpExecutableLocation;

    protected $commands = [];

    protected $commandInstances = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->commands = config('batch.to_write');

        $this->populateCommandInstancesArray();

        if(!$this->option('defaults')) {
            $this->checkIfPhpExecutableNeeded();

            $this->createFiles();

        } else {
            $this->createFilesWithoutOptions();
        }
    }

    private function convertToQuestionString(BaseBatchWriter $command, InputOption $option) {
        return $command->getExecutableName() . ' is asking: what is the value of ' . $option->getName() . '? (leave blank for ' . $option->getDefault() . ')';
    }

    private function createBatchFile(BaseBatchWriter $command) {
        $options = $command->getDefinition()->getOptions();

        if (empty($options)) {
            $this->call($command->getExecutableName());
        } else {
            $answers = [];

            foreach($options as $option) {
                if($option->getName() === config('batch.php.path_argument_name')) {
                    $answers['--' . $option->getName()] = $this->phpExecutableLocation;
                } else {
                    $answer = $this->ask($this->convertToQuestionString($command, $option));
                    $answers['--' . $option->getName()] = $this->getDefaultIfBlank($answer, $option->getDefault());
                }
            }

            $this->call($command->getExecutableName(), $answers);
        }
    }

    private function populateCommandInstancesArray()
    {
        foreach($this->commands as $command) {
            $this->commandInstances[] = new $command;
        }
    }

    private function getDefaultIfBlank($answer, $default) {
        return blank($answer) ? $default : $answer;
    }

    private function checkIfPhpExecutableNeeded()
    {
        $asked = false;

        foreach($this->commandInstances as $command) {
            foreach($command->getDefinition()->getOptions() as $option) {
                if($option->getName() === config('batch.php.path_argument_name')) {
                    $this->phpExecutableLocation = $this->getDefaultIfBlank($this->ask('What is the location of the php executable? Leave blank for ' . config('batch.php.exe_path')), config('batch.php.exe_path'));

                    break 2;
                }
            }
        }
    }

    private function createFiles()
    {
        foreach($this->commandInstances as $command) {
            $this->createBatchFile($command);
        }
    }

    private function createFilesWithoutOptions()
    {
        foreach($this->commandInstances as $command) {
            $this->call($command->getExecutableName());
        }
    }
}
