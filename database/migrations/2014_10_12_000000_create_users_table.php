<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment("campo relacion que sirve para saber a quien pertenece el usuario en caso tal de ser un conductor, solo sera null en el caso de que sea un conductor individual (no pertenece a ninguna empresa)")->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->float('valoration')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->integer('verified')->unsigned()->default('0')->comment('0 = no verificado, 1 = verificado');
            $table->integer('verified_by')->unsigned()->nullable();
            $table->index('verified_by');
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('users');
    }
}
