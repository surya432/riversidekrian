<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat');
            $table->integer('provinsi_id');
            $table->integer('kabupaten_id');
            $table->integer('kecamatan_id');
            $table->integer('kelurahan_id');
            $table->string('rt', 4);
            $table->string('rw', 4);
            $table->enum('tipe', ['Perumahan', 'Desa']);
            $table->string('foto')->nullable();
            $table->string('create_by');
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('cmps');
    }
}
