<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAsuranceChargeActRegisterAndDniEscanedToPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->string('asurance_charge')->nullable()->after('phone');
            $table->string('act_const')->nullable()->after('asurance_charge');
            $table->string('register')->nullable()->after('act_const');
            $table->string('dni_digital')->nullable()->after('register');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropColumn('asurance_charge');
            $table->dropColumn('act_const');
            $table->dropColumn('register');
            $table->dropColumn('dni_escaned');
        });
    }
}
