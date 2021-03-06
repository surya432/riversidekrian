<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_d_packages', function (Blueprint $table) {
            $table->id();
            $table->string('m_coas_id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->string('nominal');
            $table->foreignId('m_packages_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('m_d_packages');
    }
}
