<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvinsiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /* `das`.`wilayah_propinsi` */
        $wilayah_propinsi = [
            ['id' => '1', 'name' => 'Aceh', 'p_bsni' => 'ID-AC'],
            ['id' => '2', 'name' => 'Sumatra Utara', 'p_bsni' => 'ID-SU'],
            ['id' => '3', 'name' => 'Sumatra Barat', 'p_bsni' => 'ID-SB'],
            ['id' => '4', 'name' => 'Riau', 'p_bsni' => 'ID-RI'],
            ['id' => '5', 'name' => 'Jambi', 'p_bsni' => 'ID-JA'],
            ['id' => '6', 'name' => 'Sumatra Selatan', 'p_bsni' => 'ID-SS'],
            ['id' => '7', 'name' => 'Bengkulu', 'p_bsni' => 'ID-BE'],
            ['id' => '8', 'name' => 'Lampung', 'p_bsni' => 'ID-LA'],
            ['id' => '9', 'name' => 'Kepulauan Bangka Belitung', 'p_bsni' => 'ID-BB'],
            ['id' => '10', 'name' => 'Kepulauan Riau', 'p_bsni' => 'ID-KR'],
            ['id' => '11', 'name' => 'Daerah Khusus Ibukota Jakarta', 'p_bsni' => 'ID-JB'],
            ['id' => '12', 'name' => 'Jawa Barat', 'p_bsni' => 'ID-JB'],
            ['id' => '13', 'name' => 'Jawa Tengah', 'p_bsni' => 'ID-JT'],
            ['id' => '14', 'name' => 'Daerah Istimewa Yogyakarta', 'p_bsni' => 'ID-YO'],
            ['id' => '15', 'name' => 'Jawa Timur', 'p_bsni' => 'ID-JI'],
            ['id' => '16', 'name' => 'Banten', 'p_bsni' => 'ID-BT'],
            ['id' => '17', 'name' => 'Bali', 'p_bsni' => 'ID-BA'],
            ['id' => '18', 'name' => 'Nusa Tenggara Barat', 'p_bsni' => 'ID-NB'],
            ['id' => '19', 'name' => 'Nusa Tenggara Timur', 'p_bsni' => 'ID-NT'],
            ['id' => '20', 'name' => 'Kalimantan Barat', 'p_bsni' => 'ID-KB'],
            ['id' => '21', 'name' => 'Kalimantan Tengah', 'p_bsni' => 'ID-KT'],
            ['id' => '22', 'name' => 'Kalimantan Selatan', 'p_bsni' => 'ID-KS'],
            ['id' => '23', 'name' => 'Kalimantan Timur', 'p_bsni' => 'ID-KI'],
            ['id' => '24', 'name' => 'Kalimantan Utara', 'p_bsni' => 'ID-KU'],
            ['id' => '25', 'name' => 'Sulawesi Utara', 'p_bsni' => 'ID-SA'],
            ['id' => '26', 'name' => 'Sulawesi Tengah', 'p_bsni' => 'ID-ST'],
            ['id' => '27', 'name' => 'Sulawesi Selatan', 'p_bsni' => 'ID-SN'],
            ['id' => '28', 'name' => 'Sulawesi Tenggara', 'p_bsni' => 'ID-SG'],
            ['id' => '29', 'name' => 'Gorontalo', 'p_bsni' => 'ID-GO'],
            ['id' => '30', 'name' => 'Sulawesi Barat', 'p_bsni' => 'ID-SR'],
            ['id' => '31', 'name' => 'Maluku', 'p_bsni' => 'ID-MA'],
            ['id' => '32', 'name' => 'Maluku Utara', 'p_bsni' => 'ID-MU'],
            ['id' => '33', 'name' => 'Papua', 'p_bsni' => 'ID-PA'],
            ['id' => '34', 'name' => 'Papua Barat', 'p_bsni' => 'ID-PB']
        ];

        foreach ($wilayah_propinsi as $a => $b) {
            \App\Models\Provinsi::firstOrCreate(
                ["name" => $b['name'], "p_bsni" => $b['p_bsni'], "p_bsni" => $b['p_bsni']],
                ["name" => $b['name'], "p_bsni" => $b['p_bsni'], "p_bsni" => $b['p_bsni']]
            );
            $this->command->warn("wilayah_propinsi, " . $b['name'] . " " .  $b['id'] . ".");
        }
    }
}
