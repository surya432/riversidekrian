<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->string('no_rumah')->nullable();
            $table->string('blok_rumah')->nullable();
            $table->enum('status', ['Berpenghuni', 'Kosong']);
            // $table->integer('provinsi_id');
            // $table->integer('kabupaten_id');
            // $table->integer('kecamatan_id');
            // $table->integer('kelurahan_id');
            // $table->string('rt', 4);
            // $table->string('rw', 4);
            $table->integer('cmp_id');
            $table->foreignId('typerumah_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('rumahs');
    }
}
