<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCirculationCarnetAsurancePropertyTitleToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('circulation_card')->nullable()->after('ocuped');
            $table->string('asurance')->nullable()->after('circulation_card');
            $table->string('property_title')->nullable()->after('asurance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('circulation_card');
            $table->dropColumn('asurance');
            $table->dropColumn('property_title');
        });
    }
}
