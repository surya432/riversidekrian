<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportDBWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:datawilayah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Data Wilayah';

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
        $path = storage_path('database/billingrtv2.sql');
        DB::unprepared(file_get_contents($path));
        // $sql_dump = File::get($path);
        // DB::connection()->getPdo()->exec($sql_dump);
    }
}
