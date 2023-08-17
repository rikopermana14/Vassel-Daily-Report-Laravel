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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_id');
            $table->string('vessel_name');
            $table->string('email');
            $table->string('vessel_type');
            $table->string('builder');
            $table->string('class');
            $table->string('call_sign');
            $table->string('length_perpendicular');
            $table->string('depth_moulded');
            $table->string('gross_tonage');
            $table->string('cost_center');
            $table->string('work_place');
            $table->string('clear_deck_area');
            $table->string('other_spesification');
            $table->string('avaliable');
            $table->string('vessel_alias');
            $table->string('country_flag');
            $table->string('year_built');
            $table->string('official_number');
            $table->string('lenght_overall');
            $table->string('breadth_mouled');
            $table->string('draft_final');
            $table->string('netto_tonnage');
            $table->string('owner');
            $table->string('main_engine_fuel_oil_consumption');
            $table->string('auxilary_engine_fuel_oil_consumption');
            $table->string('fuel_oil_consumption_maximum');
            $table->string('fuel_oil_consumption_economic');
            $table->string('type_of_fuel');
            $table->string('maximum_speed');
            $table->string('economic_speed');
            $table->string('minimum_speed');
            $table->string('horse_power');
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
        Schema::dropIfExists('vessels');
    }
};
