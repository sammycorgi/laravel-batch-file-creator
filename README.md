# Laravel Batch File Creator

Adds some artisan commands for the generation of batch files so you don't have to open a number of terminals every time you want to start development on a windows machine.

## Installation

Install the package: `composer require sammycorgi/laravel-batch-file-installer`

Laravel should auto discover the package. If it doesn't, run `php artisan package:discover`

## Usage

By default, run `php artisan batch-make:all` to create the default batch files for a new laravel installation. This will create batch files that run the following commands:

Run this command with the --defaults flag to skip the questions, and jump straight into generating the scripts based on the default options defined in the config.

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

## Writing new batch file creators

Create a new class that extends `Sammycorgi\LaravelBatchFileCreator\Commands\BaseBatchWriter`. Make sure to implement the `getContents()` and `getCommandName()` methods!

`getContents()` will be the contents of the batch file to be written.

The base class has an `appendContents()` method, which outputs the options and their values to the script.

The `handle()` method that is required for every artisan command is defined in the base class. By default, it writes the content to the batch file and outputs a success message. 

If the script needs to access the php executable, use the `Sammycorgi\LaravelBatchFileCreator\Commands\Traits\GetsPhpExecutableInformation` trait and implement the `Sammycorgi\LaravelBatchFileCreator\Commands\Contracts\IUsesPhpExecutable` infterface. Call `$this->getPhpExecutablePath()` to get the defined path of the php executable

