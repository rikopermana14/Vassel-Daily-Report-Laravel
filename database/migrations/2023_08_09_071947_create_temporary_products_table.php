<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryProductsTable extends Migration
{
    public function up()
    {
        Schema::create('temporary_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('name');
            $table->string('spec');
            $table->integer('stock');
            $table->string('image')->nullable();
            $table->string('type');
            $table->string('alias');
            $table->string('unit');
            $table->integer('min');
            $table->string('lead');
            $table->string('delivery');
            $table->string('idle');
            $table->integer('volume');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporary_products');
    }
};
