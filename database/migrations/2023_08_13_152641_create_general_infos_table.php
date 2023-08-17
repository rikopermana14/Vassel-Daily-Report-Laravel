<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_info', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->dateTime('vessel_name');
            $table->string('vessel_group');
            $table->string('general_position');
            $table->string('master_name');
            $table->string('time_zone');
            $table->string('latitude');
            $table->string('longtuide');
            $table->string('scale_sea');
            $table->string('wind');
            $table->string('weather');
            $table->string('tempratur');
            $table->string('destination');
            $table->string('eta');
            $table->string('distance_run');
            $table->string('total_distance');
            $table->string('time_run');
            $table->string('total_time');
            $table->string('avarage_speed');
            $table->string('general_avarage_speed');
            $table->string('visibility_scale');
            $table->string('scale_of_wind_force');
            $table->string('barometer');
            $table->string('vessel_course');
            $table->string('distance_to_go');
            $table->string('towage_operation');
            $table->string('size_grt');
            $table->string('vessel_status');
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
        Schema::dropIfExists('general_infos');
    }
};
