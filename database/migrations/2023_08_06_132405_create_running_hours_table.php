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
        Schema::create('running_hours', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('machine');
            $table->string('towing');
            $table->string('manouver');
            $table->string('slow');
            $table->string('economi');
            $table->string('full_speed');
            $table->string('standby');
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
        Schema::dropIfExists('running_hours');
    }
};
