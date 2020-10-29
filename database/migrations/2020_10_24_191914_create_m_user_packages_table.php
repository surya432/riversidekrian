<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user_packages', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->enum('status', ['open', 'in-proses', 'paid', 'closed', 'post'])->default('open');
            $table->date('date')->nullable();
            $table->string('totalTagihan');
            $table->string('update_by')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('m_user_packages');
    }
}
