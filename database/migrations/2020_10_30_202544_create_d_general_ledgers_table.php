<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDGeneralLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_ledger_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('sequence');
            $table->integer('id_coa');
            $table->enum('debet_credit', ['debet', 'credit'])->default('debet');
            $table->integer('total');
            $table->text('ref')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('type_transaksi', 40)->nullable();
            $table->enum('status', ['in process', 'post'])->default('in process');
            $table->integer('user_confirm')->nullable();
            $table->integer('user_cancel')->nullable();
            $table->date('confirm_date')->nullable();
            $table->boolean('print')->default(false);
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
        Schema::dropIfExists('d_general_ledgers');
    }
}
