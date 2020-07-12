<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kotobas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kotobas', function(Blueprint $table){
            $table->id();
            $table->integer('bab');
            $table->string('huruf', 255);
            $table->string('kanji', 255);
            $table->string('romaji', 255);
            $table->string('arti', 255);
            $table->string('keterangan', 255);
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
