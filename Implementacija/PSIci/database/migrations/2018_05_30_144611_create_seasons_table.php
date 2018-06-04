<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
           $table->integer('content_id')->unsigned();
           $table->foreign('content_id')->references('id')->on('contents');
           $table->integer('tvshow_id')->unsigned();
           $table->foreign('tvshow_id')->references('content_id')->on('tvshows');
           $table->integer('number_of_episodes')->nullable();
           $table->integer('season_number')->unsigned();
           $table->primary('content_id');
           $table->timestamps();
           $table->unique(['tvshow_id','season_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
