<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->enum('status', ['open', 'in-approval', 'approved', 'post', 'closed'])->default('open');
            $table->date('date')->nullable();
            $table->string('total');
            $table->string('note')->nullable();
            $table->string('create_by')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_confirm')->nullable();
            $table->integer('user_cancel')->nullable();
            $table->date('confirm_date')->nullable();
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
        Schema::dropIfExists('pengeluarans');
    }
}
