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
        Schema::create('vdr', function (Blueprint $table) {
            $table->id();
            $table->string('id_general_info');
            $table->string('id_daily_activities');
            $table->string('id_running_hours');
            $table->string('id_consumption');
            $table->string('id_muaatan');
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
        Schema::dropIfExists('vdr');
    }
};
