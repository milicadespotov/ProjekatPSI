<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents');
            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')->references('content_id')->on('seasons');
            $table->integer('length')->unsigned()->nullable();
            $table->integer('episode_number')->unsigned();
            $table->primary('content_id');
            $table->timestamps();
            $table->unique(['season_id','episode_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
