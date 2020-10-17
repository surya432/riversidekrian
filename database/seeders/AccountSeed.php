<?php

namespace Database\Seeders;

use App\Models\Cmp;
use App\Models\Homeuser;
use App\Models\Rumah;
use App\Models\Typerumah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            // $this->command->call("migrate:rollback");
            // $this->command->call('migrate');

            $this->command->warn("Data cleared, starting from blank database. stepto ");

            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions
            Permission::create(['name' => 'edit']);
            Permission::create(['name' => 'delete']);
            Permission::create(['name' => 'publish']);
            Permission::create(['name' => 'setting']);
            Permission::create(['name' => 'superadmin']);

            // create roles and assign created permissions

            // this can be done as separate statements
            $role = Role::create(['name' => 'writer']);
            $role->givePermissionTo('edit');

            // or may be done by chaining
            $role = Role::create(['name' => 'admin'])
                ->givePermissionTo(['setting', 'publish']);
            $role = Role::create(['name' => 'superadmin'])
                ->givePermissionTo(['setting', 'publish']);

            $Cmp = Cmp::create([
                "name" => "Super-Admin",
                "alamat" => "Kesimbukan RT/RW 02/01",
                "provinsi_id" => 15,
                "kabupaten_id" => 240,
                "kecamatan_id" => 3527,
                "kelurahan_id" => 43688,
                "tipe" => "Desa",
                "create_by" => "surya",
            ]);

            Typerumah::create(['name' => "Penghuni Kontrak"]);
            $typeRumah = Typerumah::create(['name' => "Penghuni Tetap"]);
            $role = Role::create(['name' => 'super-admin']);
            $role->givePermissionTo(Permission::all());
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
            $rumah = Rumah::create([
                "no_rumah" => "78",
                "blok_rumah" => "selatan jalan",
                "status" => 'Berpenghuni',
                "provinsi_id" => 15,
                "kabupaten_id" => 240,
                "kecamatan_id" => 3527,
                "kelurahan_id" => 43688,
                "typerumah_id" => $typeRumah->id,
                'cmp_id' => $Cmp->id,
            ]);
            Homeuser::create(['user_id' => $user->id, 'cmp_id' => $Cmp->id, 'rumah_id' => $rumah->id]);
            $user->syncRoles(['super-admin']);
            $this->command->call('setting:freshall');
        } else {
            $this->command->warn("Cancel Action");
        }
    }
}
