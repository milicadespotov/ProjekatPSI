<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directings', function (Blueprint $table) {
            $table->integer('director_id')->unsigned();
            $table->foreign('director_id')->references('category_id')->on('directors');
            $table->integer('tvshow_id')->unsigned();
            $table->foreign('tvshow_id')->references('content_id')->on('tvshows');
            $table->primary(['director_id', 'tvshow_id']);
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
        Schema::dropIfExists('directings');
    }
}
