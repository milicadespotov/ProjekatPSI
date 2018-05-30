<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchedEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watched_episodes', function (Blueprint $table) {
            $table->string('user_id');
            $table->foreign('user_id')->references('username')->on('users');
            $table->integer('episode_id')->unsigned();
            $table->foreign('episode_id')->references('content_id')->on('seasons');
            $table->primary(['user_id', 'episode_id']);
            //dateAndTime je kolona created_at
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
        Schema::dropIfExists('watched_episodes');
    }
}
