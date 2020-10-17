<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client as GClient;

class WilayahSeed extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      //
      if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
         // Call the php artisan migrate:refresh
         $this->command->call('migrate:fresh');
         $this->command->warn("Data cleared, starting from blank database.");

         $curl = new  GClient();
         $resp = $curl->get("http://apps-01.host-media.web.id:8091/vendor-api/propinsi");
         if ($resp->getStatusCode() == 200) {
            $body = json_decode($resp->getBody(), true);
            foreach ($body['data'] as $a => $b) {
               $datapropinsi = Provinsi::firstOrCreate(["name" => $b['nama'], 'id' => $b['id']]);
               $this->command->warn("Data Propinsi," . $b['nama'] . " " .  $b['id'] . ".");
            }
         }
         $proponsidb = Provinsi::all();
         foreach ($proponsidb as $a => $propinsi) {
            $client = new  GClient();
            $resp = $client->post("http://apps-01.host-media.web.id:8091/vendor-api/kabupaten", ["json" => ["id" => $propinsi['id']]]);
            if ($resp->getStatusCode() == 200) {
               $body = json_decode($resp->getBody(), true);
               foreach ($body['data'] as $a => $b) {
                  $datakabupaten = Kabupaten::firstOrCreate(["name" => $b['nama'], 'id' => $b['id']], ["provinsi_id" => $propinsi['id']]);
                  $this->command->warn("Data Kabupaten," . $b['nama'] . " " .  $b['id'] . ".");
               }
            }
         }
         $kabupatenID = Kabupaten::all();
         foreach ($kabupatenID as $a => $kabupaten) {
            $client = new  GClient();
            $resp = $client->post("http://apps-01.host-media.web.id:8091/vendor-api/kecamatan", ["json" => ["id" => $kabupaten['id']]]);
            if ($resp->getStatusCode() == 200) {
               $body = json_decode($resp->getBody(), true);
               foreach ($body['data'] as $a => $b) {
                  $datakabupaten = Kecamatan::firstOrCreate(["name" => $b['nama'], 'id' => $b['id']], ["kabupaten_id" => $kabupaten['id']]);
                  $this->command->warn("Data kecamatan," . $b['nama'] . " " .  $b['id'] . ".");
               }
            }
         }
         $kecamatanDb = Kecamatan::all();
         foreach ($kecamatanDb as $a => $kecamatan) {
            $client = new  GClient();
            $resp = $client->post("http://apps-01.host-media.web.id:8091/vendor-api/desa", ["json" => ["id" => $kecamatan['id']]]);
            if ($resp->getStatusCode() == 200) {
               $body = json_decode($resp->getBody(), true);
               foreach ($body['data'] as $a => $b) {
                  Kelurahan::firstOrCreate(["name" => $b['nama'], 'id' => $b['id']], ["kecamatan_id" => $kecamatan['id']]);
                  $this->command->warn("Data Kelurahan," . $b['nama'] . " " .  $b['id'] . ".");
               }
            }
         }
         // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // // create permissions
         // Permission::create(['name' => 'edit']);
         // Permission::create(['name' => 'delete']);
         // Permission::create(['name' => 'publish']);
         // Permission::create(['name' => 'setting']);
         // Permission::create(['name' => 'setting super-admin']);

         // // create roles and assign created permissions

         // // this can be done as separate statements
         // $role = Role::create(['name' => 'writer']);
         // $role->givePermissionTo('edit');

         // // or may be done by chaining
         // $role = Role::create(['name' => 'admin'])
         //    ->givePermissionTo(['setting', 'publish']);

         // $Cmp = Cmp::create([
         //    "name" => "Super-Admin",
         //    "alamat" => "Kesimbukan RT/RW 02/01",
         //    "provinsi_id" => 15,
         //    "kabupaten_id" => 240,
         //    "kecamatan_id" => 3527,
         //    "kelurahan_id"=>43688,
         //    "tipe"=>"Desa",
         //    "create_by"=>"surya",
         // ]);
         // $role = Role::create(['name' => 'super-admin']);
         // $role->givePermissionTo(Permission::all());
         // $user = \App\User::create([
         //    'name' => "Surya Hadi P",
         //    'email' => "hadisurya295@gmail.com",
         //    'password' => Hash::make("12345678"),
         //    'cmp_id' => $Cmp->id,
         // ]);
         // $user->syncRoles(['super-admin']);
         // $this->command->call('setting:freshall');
      } else {
         $this->command->warn("Cancel Action");
      }
   }
}
