<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products',function(Blueprint $table){
           $table->increments('id');
           $table->string('name_ua');
           $table->string('name_ru');
           $table->text('description_ua');
           $table->text('description_ru');
           $table->string('article');
           $table->float('price');
           $table->boolean('is_popular')->default(0);
           $table->boolean('is_active')->default(0);
           $table->integer('category_id');
           $table->boolean('for_man')->default(0);
           $table->boolean('for_woman')->default(0);
           $table->boolean('for_children')->default(0);
           $table->string('main_image');
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
