<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('frontImg');
            $table->string('backImg');
            $table->text('content');
            $table->bigInteger('weight');
            $table->bigInteger('price');
            $table->integer('discount')->nullable();
            $table->timestamps();

            $table->foreign('catalog_id')->references('id')->on('catalogs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
