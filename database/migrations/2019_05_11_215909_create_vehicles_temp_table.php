<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_temp_id');
            $table->unsignedInteger('transport_id');
            $table->unsignedInteger('weight_id');
            $table->unsignedInteger('bulk_id');
            $table->index('user_temp_id');
            $table->index('transport_id');
            $table->index('weight_id');
            $table->index('bulk_id');
            $table->string('license_plate', 45);
            $table->double('capacity', 10, 2)->nullable();
            $table->string('photo');

            $table->foreign('user_temp_id')->references('id')->on('users_temp')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bulk_id')->references('id')->on('bulks')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('vehicles_temp');
    }
}
