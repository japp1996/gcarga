<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('transport_id');
            $table->unsignedInteger('weight_id');
            $table->unsignedInteger('bulk_id');
            $table->unsignedInteger('registered_id')->nullable();

            $table->index('user_id');
            $table->index('model_id');
            $table->index('transport_id');
            $table->index('weight_id');
            $table->index('bulk_id');
            $table->index('registered_id');

            $table->string('license_plate', 45);
            $table->string('color');
            $table->integer('year');
            $table->double('capacity', 10, 2)->nullable();
            $table->double('price', 10, 2)->nullable()->default(0);
            $table->string('serial', 45);
            $table->integer('verified_docs');
            $table->integer('insured');
            $table->enum('status', ['0','1','2']);
            $table->enum('ocuped', ['0', '1'])->comment('Indica si el vehículo esta en uso, 1 = esta en uso, 0 = no esta en uso')->default('0');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bulk_id')->references('id')->on('bulks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('registered_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('vehicles');
    }
}
