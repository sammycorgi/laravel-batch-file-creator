# Laravel Batch File Creator

Adds some artisan commands for the generation of batch files so you don't have to open a number of terminals every time you want to start development on a windows machine.

## Installation

Install the package: `composer require sammycorgi/laravel-batch-file-installer`

Laravel should auto discover the package. If it doesn't, run `php artisan package:discover`

## Usage

By default, run `php artisan batch-make:all` to create the default batch files for a new laravel installation. This will create batch files that run the following commands:

Run this command with the `--defaults` flag to skip the questions, and jump straight into generating the scripts based on the default options defined in the config.

* `php artisan serve`
* `php artisan queue:work`
* `php artisan schedule:run`
* `npm run watch` - be sure to install npm or this won't work!
* `cd [project-path]` - opens the terminal to the project path

The script will ask for certain options such as the `php.exe` path and queue worker options.

## Config

To change these defaults, first publish the config package by running `php artisan vendor:publish --tag=config --provider=Sammycorgi\LaravelBatchFileCreator\ServiceProvider`

This will create a config file at `config/batch.php`

#### Notable config entries

`folder_path` - This is the folder that the batch files will be written to. Default is `base_path('batch')`

`php.exe_path` - Location of the php executable. Default is `C:\xampp\php\php.exe`

`to_write` - The batch files created by the `batch-make:all` command. Be sure that these are in the correct order!

## Writing new batch file creators

Create a new class that extends `Sammycorgi\LaravelBatchFileCreator\Commands\BaseBatchWriter`. Make sure to implement the `getContents()` and `getCommandName()` methods!

If the command has any arguments, create an options definition class that extends `Sammycorgi\LaravelBatchFileCreator\Commands\Options\Definitions\Definition` and implement the `getDefinitions()` method. This will return an array of arrays - one array for each option. The `name` of the option is required. You can also define the `default` and the `description` of the option.

Make sure to add an entry to the `definitions` array in the config to map this definition to the command. Syntax is `[creator_class_name] => [definition_class_name (or null if no options)]`

`getContents()` will be the contents of the batch file to be written.

The base class has an `appendContents()` method, which outputs the options and their values to the script.

The `handle()` method that is required for every artisan command is defined in the base class. By default, it writes the content to the batch file and outputs a success message. 

If the script needs to access the php executable, use the `Sammycorgi\LaravelBatchFileCreator\Commands\Traits\GetsPhpExecutableInformation` trait and implement the `Sammycorgi\LaravelBatchFileCreator\Commands\Contracts\IUsesPhpExecutable` interface. Call `$this->getPhpExecutablePath()` to get the defined path of the php executable

