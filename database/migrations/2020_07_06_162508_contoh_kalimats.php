<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContohKalimats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contoh_kalimats', function(Blueprint $table){
            $table->id();
            $table->integer('bab');
            $table->string('tanya', 255);
            $table->string('jawab', 255);
            $table->string('artanya', 255);
            $table->string('arjawab', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contoh_kalimats');
    }
}
