<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop-all-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables from the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $tables = DB::select('SHOW TABLES');
        $database = DB::getDatabaseName();
        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_$database"};
            Schema::drop($tableName);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->info('All tables dropped successfully.');
    }
}

