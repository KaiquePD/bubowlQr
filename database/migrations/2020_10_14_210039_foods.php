<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_segment');
            $table->string('name');
            $table->string('desc');
            $table->float('price', 5, 2);
            $table->enum('status', ['on', 'off'])->default('on');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('id_segment')->references('id')->on('segments')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
