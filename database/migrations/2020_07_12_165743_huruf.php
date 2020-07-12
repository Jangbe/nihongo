<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Huruf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huruf', function(Blueprint $table){
            $table->id();
            $table->integer('bab');
            $table->string('hiragana', 255);
            $table->string('katakana', 255);
            $table->string('romaji', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huruf');
    }
}
