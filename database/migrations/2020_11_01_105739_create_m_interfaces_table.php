<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('cmp_id', 5)->nullable();
            $table->string('var', 60);
            $table->text('code_coa')->nullable();
            $table->text('desc')->nullable();
            $table->enum('status', ['active', 'not active'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_interfaces');
    }
}
