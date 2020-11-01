<?php

namespace Database\Seeders;

use App\Models\MInterface;
use Illuminate\Database\Seeder;

class InterfaceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intervace = [
            [
                'var' => 'VAR_RECEIPT',
                'code_coa' => '401',
                'cmp_id' => "1"
            ],
            [
                'var' => 'VAR_EXPENSE',
                'code_coa' => '7,9',
                'cmp_id' => "1"
            ],
            [
                'var' => 'VAR_CASH',
                'code_coa' => '10101',
                'cmp_id' => "1"
            ],
            [
                'var' => 'VAR_BANK',
                'code_coa' => '10102',
                'cmp_id' => "1"
            ],
            [
                'var' => 'VAR_HUTANG',
                'code_coa' => '2010101',
                'cmp_id' => "1"
            ],
            [
                'var' => 'VAR_PIUTANG',
                'code_coa' => '1010301',
                'cmp_id' => "1"
            ],
            // [
            //     'var' => 'VAR_DEBETNOTE_HUTANG_CREDIT',
            //     'code_coa' => '50101', 
            //     'cmp_id' => "1"
            // ],
            // [
            //     'var' => 'VAR_DEBETNOTE_PIUTANG_CREDIT',
            //     'code_coa' => '40301', 
            //     'cmp_id' => "1"
            // ],
            // [
            //     'var' => 'VAR_CREDITNOTE_HUTANG_DEBET',
            //     'code_coa' => '2010101', 
            //     'cmp_id' => "1"
            // ],
            // [
            //     'var' => 'VAR_CREDITNOTE_PIUTANG_DEBET',
            //     'code_coa' => '1010301',
            //     'cmp_id' => "1"
            // ],
        ];
        foreach ($intervace as $a => $b) {
            MInterface::create($b);
        }
    }
}
