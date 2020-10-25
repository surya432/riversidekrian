<?php

namespace Database\Seeders;

use App\Models\Cmp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class COASeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            array("code" => 1, "desc" => "AKTIVA", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 101, "desc" => "AKTIVA LANCAR", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10101, "desc" => "KAS", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010101, "desc" => "KAS KECIL", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010102, "desc" => "KAS BESAR", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10103, "desc" => "PIUTANG", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010301, "desc" => "BON SEMENTARA", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010302, "desc" => "PIUTANG IURAN RUTIN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010302, "desc" => "PIUTANG IURAN SAMPAH", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010302, "desc" => "PIUTANG IURAN SOSIAL", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10104, "desc" => "UANG MUKA PEMBELIAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010401, "desc" => "UANG MUKA PEMBELIAN  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10105, "desc" => "BIAYA DIBAYAR DIMUKA", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010501, "desc" => "BIAYA DIBAYAR DIMUKA  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10106, "desc" => "SEWA DIBAYAR DIMUKA", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1010601, "desc" => "SEWA DIBAYAR DIMUKA  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 102, "desc" => "AKTIVA TETAP", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10201, "desc" => "TANAH", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10202, "desc" => "BANGUNAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1020201, "desc" => "BANGUNAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10203, "desc" => "KENDARAAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1020301, "desc" => "KENDARAAN  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 103, "desc" => "AKM.PENYUSUTAN AKTIVA", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10301, "desc" => "AKM.PENYUSUTAN BANGUNAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1030101, "desc" => "AKM.PENYUSUTAN BANGUNAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10302, "desc" => "AKM.PENYUSUTAN KENDARAAN", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1030201, "desc" => "AKM.PENYUSUTAN KENDARAAN  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 10303, "desc" => "AKM.PENYUSUTAN INVENTARIS", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 1030301, "desc" => "AKM.PENYUSUTAN INVENTARIS  ", "debet_credit" => "debet", "grup" => "ASSET"),
            array("code" => 4, "desc" => "PENDAPATAN", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 401, "desc" => "PENDAPATAN IUARAN", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 40101, "desc" => "PENDAPATAN IURAN RUTIN", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 40102, "desc" => "PENDAPATAN IURAN SOSIAL", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 40103, "desc" => "PENDAPATAN IURAN SAMPAH", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 7, "desc" => "BIAYA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 701, "desc" => "BIAYA KARYAWAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70101, "desc" => "GAJI  POKOK", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70102, "desc" => "UANG MAKAN KARYAWAN  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70103, "desc" => "BIAYA LEMBUR KARYAWAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70104, "desc" => "BIAYA PENGOBATAN KARYAWAN  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70105, "desc" => "BIAYA BONUS LAIN-LAIN KARYAWAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70106, "desc" => "TUNJANGAN HARI RAYA  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70107, "desc" => "BIAYA BPJS", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 702, "desc" => "BIAYA KENDARAAN OPERASIONAL", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70201, "desc" => "BIAYA BAHAN BAKAR KENDARAAN MOBIL", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70202, "desc" => "BIAYA BAHAN BAKAR KENDARAAN MOTOR", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70203, "desc" => "BIAYA BAHAN BAKAR KENDARAAN KANVAS", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70204, "desc" => "BIAYA RETRIBUSI DAN PARKIR", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70205, "desc" => "BIAYA SURAT-SURAT KENDARAAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70206, "desc" => "BIAYA MAINTENANCE KENDARAAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 703, "desc" => "BIAYA UMUM ADMINISTRASI KANTOR", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70301, "desc" => "ALAT TULIS KANTOR/FOTOCOPY", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70302, "desc" => "BIAYA TELEPON DAN PULSA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70303, "desc" => "BIAYA INTERNET", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70304, "desc" => "BIAYA POS DAN MATERAI", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70305, "desc" => "BIAYA LISTRIK", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70306, "desc" => "BIAYA PDAM", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70307, "desc" => "BIAYA SAMPAH  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70308, "desc" => "BIAYA KONSUMSI KANTOR", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70309, "desc" => "BIAYA PERJALANAN DINAS  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70310, "desc" => "BIAYA SUMBANGAN  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70311, "desc" => "BIAYA ENTERTAINMENT  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70312, "desc" => "BIAYA PAMERAN  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70313, "desc" => "BIAYA IKLAN DAN ADVERTENSI", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70314, "desc" => "BIAYA SEWA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70315, "desc" => "BIAYA ASURANSI", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70316, "desc" => "BIAYA KONSULTAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70321, "desc" => "BIAYA RUMAH TANGGA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 704, "desc" => "BIAYA PERBAIKAN AKTIVA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70401, "desc" => "BIAYA PERBAIKAN BANGUNAN  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70402, "desc" => "BIAYA PERBAIKAN KENDARAAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70403, "desc" => "BIAYA PERBAIKAN INVENTARIS", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 705, "desc" => "BIAYA PENYUSUTAN AKTIVA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70501, "desc" => "BIAYA PENYUSUTAN BANGUNAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70502, "desc" => "BIAYA PENYUSUTAN KENDARAAN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70503, "desc" => "BIAYA PENYUSUTAN INVENTARIS", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 706, "desc" => "BIAYA BANK", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70601, "desc" => "BIAYA BUNGA", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 70602, "desc" => "BIAYA ADMINISTRASI BANK", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 8, "desc" => "PENDAPATAN NON OPERASI", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 801, "desc" => "PENDAPATAN BUNGA BANK", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 80101, "desc" => "PENDAPATAN BUNGA BANK  ", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 802, "desc" => "PENDAPATAN BUNGA LAIN-LAIN", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 80201, "desc" => "PENDAPATAN BUNGA LAIN-LAIN  ", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 803, "desc" => "LABA/RUGI PENJUALAN AKTIVA", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 80301, "desc" => "LABA/RUGI PENJUALAN AKTIVA  ", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 804, "desc" => "PENDAPATAN NON OPERASI LAIN", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 80401, "desc" => "PENDAPATAN NON OPERASI LAIN  ", "debet_credit" => "credit", "grup" => "REVENUE"),
            array("code" => 9, "desc" => "BIAYA NON OPERASI", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 901, "desc" => "BIAYA BUNGA BANK", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 90101, "desc" => "BIAYA BUNGA BANK  ", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 902, "desc" => "BIAYA ADMINISTRASI BANK LAIN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 90201, "desc" => "BIAYA ADMINISTRASI BANK LAIN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 903, "desc" => "BIAYA NON OPERASI LAIN", "debet_credit" => "debet", "grup" => "EXPENSE"),
            array("code" => 90301, "desc" => "BIAYA NON OPERASI LAIN  ", "debet_credit" => "debet", "grup" => "EXPENSE")


        );
        foreach ($data as $raw_data) {
            $raw_data['debet_credit'] = strtolower($raw_data['debet_credit']);
            $raw_data['cmp_id'] = Cmp::first()->id;

            DB::table('m_coas')->insert($raw_data);
        }


        $data_coa = DB::table('m_coas')
            ->get();

        foreach ($data_coa as $raw_data2) {
            $parent_code = '';
            $code_length = strlen($raw_data2->code);
            $code = $raw_data2->code;

            if ($code_length > 2) {
                $parent_code = substr($code, 0, $code_length - 2);
            } else if ($code_length > 1) {
                $parent_code = substr($code, 0, $code_length - 1);
            }

            $parent_id = DB::table('m_coas')
                ->where('code', $parent_code)
                ->pluck('id')
                ->first();

            DB::table('m_coas')
                ->where('code', $raw_data2->code)
                ->update(['parent_id' => (int)$parent_id]);
        }
    }
}
