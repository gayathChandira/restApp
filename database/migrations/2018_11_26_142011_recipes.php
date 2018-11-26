<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Recipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dish_id')->default(0);
            $table->string('dish_name');
            $table->string('ingredients')->nullable();   
            $table->string('amount')->nullable();      
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
        //
    }
}
