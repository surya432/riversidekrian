<?php

namespace Database\Seeders;

use App\Models\Cmp;
use App\Models\Homeuser;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Rumah;
use App\Models\Typerumah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $batch = DB::table('migrations')->orderBy('batch', "desc")->first();
            $this->command->warn("Data cleared, starting from blank database. stepto " . $batch->batch);
            $this->command->call("migrate:fresh");
            $this->command->call('migrate');

            // DB::unprepared(File::get(base_path('database\seeders\billingrt.sql')));

            $this->command->warn("Data cleared, starting from blank database. stepto ");

            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            Permission::create(['name' => 'edit']);
            Permission::create(['name' => 'delete']);
            Permission::create(['name' => 'publish']);
            Permission::create(['name' => 'show']);
            Permission::create(['name' => 'setting']);
            // create roles and assign created permissions

            // this can be done as separate statements
            $role = Role::create(['name' => 'warga']);
            $role->givePermissionTo('show');
            $role = Role::create(['name' => 'bendahara']);
            $role->givePermissionTo('show', 'edit', 'publish');

            Role::create(['name' => 'kepala-rt'])
                ->givePermissionTo(['edit', 'delete', 'publish', 'show']);
            $Cmp = Cmp::create([
                "name" => "Super-Admin",
                "alamat" => "Kesimbukan",
                "provinsi_id" => 15,
                "kabupaten_id" => 240,
                "kecamatan_id" => 3527,
                "kelurahan_id" => 43688,
                "tipe" => "Desa",
                "rt" => "01",
                "rw" => "02",
                "tipe" => "Desa",
                "create_by" => "surya",
            ]);
            Typerumah::create(['name' => "Penghuni Kontrak"]);
            $typeRumah = Typerumah::create(['name' => "Penghuni Tetap"]);
            $role = Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());
            $user = User::create([
                'name' => "Surya Hadi P",
                'email' => "hadisurya295@gmail.com",
                'tlpn' => "085748990057",
                'password' => Hash::make("12345678"),
                "alamat" => "Kesimbukan 02/01",
                "rt" => "02",
                "rw" => "01",
                "provinsi_id" => 15,
                "kabupaten_id" => 240,
                "kecamatan_id" => 3527,
                "kelurahan_id" => 43688,
                'cmp_id' => $Cmp->id,
            ]);

            // Homeuser::create(['user_id' => $user->id, 'cmp_id' => $Cmp->id, 'rumah_id' => $rumah->id]);
            $user->syncRoles(['super-admin']);
            $user2 = User::create([
                'name' => "Surya Hadi P2",
                'email' => "hadisurya107@gmail.com",
                'tlpn' => "085748990057",
                'password' => Hash::make("12345678"),
                "alamat" => "Kesimbukan 02/01",
                "rt" => "02",
                "rw" => "01",
                "provinsi_id" => 15,
                "kabupaten_id" => 240,
                "kecamatan_id" => 3527,
                "kelurahan_id" => 43688,
                'cmp_id' => $Cmp->id,
            ]);
            $user2->syncRoles(['kepala-rt']);
            $rumah = Rumah::create([
                "no_rumah" => "78",
                "blok_rumah" => "selatan jalan",
                "status" => 'Berpenghuni',
                // "provinsi_id" => 15,
                // "kabupaten_id" => 240,
                // "kecamatan_id" => 3527,
                // "kelurahan_id" => 43688,
                "typerumah_id" => $typeRumah->id,
                'cmp_id' => $Cmp->id,
            ]);
            Homeuser::create(['user_id' => $user2->id, 'cmp_id' => $Cmp->id, 'rumah_id' => $rumah->id]);

            $this->command->call('setting:freshall');
        } else {
            $this->command->warn("Cancel Action");
        }
    }
}
