<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('tipe', ['Bulanan', 'Sekali'])->default('Sekali');
            $table->date('date');
            $table->date('duedate');
            $table->string('create_by');
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('m_packages');
    }
}
