<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_temp_id')->nullable()->unsigned();
            $table->string('dni', 20)->nullable();
            $table->index('user_temp_id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->enum('sex',['0','1','2'])->default('0')->comment('0 = no definido, 1 = hombre, 2 = mujer');         
            $table->text('address')->nullable();
            $table->string('phone'); 
            $table->timestamps();

            $table->foreign('user_temp_id')->references('id')->on('users_temp')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons_temp');
    }
}
