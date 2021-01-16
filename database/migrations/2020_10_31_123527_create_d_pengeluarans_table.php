<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('pengeluaran_id');
            $table->string('desc');
            $table->string('m_coas_id');
            $table->integer('nominal');
            $table->integer('cmp_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_pengeluarans');
    }
}
