<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pizzas')){
        Schema::create('pizzas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price');
            $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('pizza_categories')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('pizzas', function($table) {
            // $table->foreign('category_id')->references('id')->on('pizza_categories');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
