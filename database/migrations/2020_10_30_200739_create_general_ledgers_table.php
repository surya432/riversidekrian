<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('general_ledger_date');
            $table->string('general_ledger_periode', 8)->nullable();
            $table->text('general_ledger_ref')->nullable();
            $table->text('general_ledger_keterangan')->nullable();
            $table->enum('general_ledger_status', ['in process', 'post'])->default('in process');
            $table->string('general_ledger_type', 15)->nullable();
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
        Schema::dropIfExists('general_ledgers');
    }
}
