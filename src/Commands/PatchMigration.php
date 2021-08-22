<?php

namespace Human018\LaravelPatch\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PatchMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:patch {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a database migration and associated patch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name' => $this->input->getArgument('name'),
            '--create' => $this->input->getOption('create'),
            '--table' => $this->input->getOption('table'),
            '--path' => $this->input->getOption('path')
        ]);

        $name = 'Patches/' . Str::ucfirst(Str::camel(trim($this->input->getArgument('name')))) . 'Patch';
        $this->callSilently('make:command', [
            'name' => $name,
            '--command' => 'patch:' . $this->input->getArgument('name')
        ]);

        $this->line("<info>Created Command:</info> {$name}");
    }
}
