<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('dni');
            $table->unsignedInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('account_number');
            $table->tinyInteger('account_type')->comment('1:ahorro,2:corriente');
            $table->integer('status')->default(1)->comment('0:inactivo, 1:activo, 2:eliminado');
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
        Schema::table('bank_user', function (Blueprint $table) {
            $table->dropForeign('bank_user_bank_id_foreign');
            $table->dropForeign('bank_user_user_id_foreign');
        });
        Schema::dropIfExists('bank_user');
    }
}
