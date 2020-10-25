<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_coas', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('desc', 100);
            $table->enum('debet_credit', ['debet', 'credit'])->default('debet');
            $table->string('grup', 50);
            $table->integer('parent_id')->default(0);
            $table->enum('status', ['active', 'pasif'])->default('active');
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
        Schema::dropIfExists('m_coas');
    }
}
