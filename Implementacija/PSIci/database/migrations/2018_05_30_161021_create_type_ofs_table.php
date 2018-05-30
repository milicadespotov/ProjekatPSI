<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeOfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_ofs', function (Blueprint $table) {
            $table->integer('tvshow_id')->unsigned();
            $table->foreign('tvshow_id')->references('content_id')->on('tvshows');
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('category_id')->on('genres');
            $table->primary(['tvshow_id', 'genre_id']);
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
        Schema::dropIfExists('type_ofs');
    }
}
