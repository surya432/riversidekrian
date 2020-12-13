<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::unguard();


        //    $this->command->call("migrate:fresh");
        // $this->command->call('migrate');
        $this->command->call('import:datawilayah');
        // $this->command->call('setting:freshall');

        $this->call([

            // ProvinsiSeed::class,
            // KabupatenSeed::class,
            // KecamatanSeed::class,
            // KelurahanSeed::class,
            AccountSeed::class,
            COASeed::class,
            InterfaceSeed::class,
        ]);
        $this->command->call('setting:freshall');
    }
}
