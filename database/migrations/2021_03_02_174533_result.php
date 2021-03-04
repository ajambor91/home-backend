<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Result extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function($table){
            $table->increments('id');
            $table->string('name');
            $table->integer('points');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
        Schema::create('app', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password', 60);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('results');
        Schema::drop('app');
    }
}
