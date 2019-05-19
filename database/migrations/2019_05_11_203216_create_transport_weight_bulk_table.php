<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportWeightBulkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_weight_bulk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transport_id')->unsigned();
            $table->integer('weight_id')->unsigned();
            $table->integer('bulk_id')->unsigned();
            $table->integer('registered_by')->unsigned();
            
            $table->index('transport_id');
            $table->index('weight_id');
            $table->index('bulk_id');
            $table->index('registered_by');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transport_id')->references('id')->on('transports')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('weight_id')->references('id')->on('weights')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bulk_id')->references('id')->on('bulks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('registered_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_weight_bulks');
    }
}
