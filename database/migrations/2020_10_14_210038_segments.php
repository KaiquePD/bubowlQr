<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Segments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_rest');
            $table->string('name');
            $table->string('desc');
            $table->enum('status', ['on', 'off'])->default('on');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('id_rest')->references('id')->on('rests')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segments');
    }
}
