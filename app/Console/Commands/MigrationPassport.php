<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrationPassport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_passport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs both migrate:fresh --seed && passport:install';

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
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('passport:install');

        return 0;
    }
}
