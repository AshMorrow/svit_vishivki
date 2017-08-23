<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductCharacteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_characteristics', function (Blueprint $table){
           $table->unsignedInteger('p_id');
           $table->unsignedInteger('c_id');

           $table->foreign('p_id')->references('id')->on('products');
           $table->foreign('c_id')->references('id')->on('characteristics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
