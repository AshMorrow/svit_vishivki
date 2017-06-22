<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors',function (Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger('ac_id');
           $table->unsignedInteger('p_id');

           $table->foreign('ac_id')->references('id')->on('available_colors');
           $table->foreign('p_id')->references('id')->on('products')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colors');
    }
}
