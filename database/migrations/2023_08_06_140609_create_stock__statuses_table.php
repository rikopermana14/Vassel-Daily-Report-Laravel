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
        Schema::create('stock_status', function (Blueprint $table) {
            $table->id();
            $table->dateTime('product_id');
            $table->dateTime('date');
            $table->string('name');
            $table->string('spec');
            $table->string('previous');
            $table->string('receive');
            $table->string('use');
            $table->string('transfer');
            $table->string('soud');
            $table->string('remain');
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
        Schema::dropIfExists('stock__statuses');
    }
};
