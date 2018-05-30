<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actings', function (Blueprint $table) {
           $table->integer('actor_id')->unsigned();
           $table->foreign('actor_id')->references('category_id')->on('actors');
           $table->integer('tvshow_id')->unsigned();
           $table->foreign('tvshow_id')->references('content_id')->on('tvshows');
           $table->primary(['actor_id', 'tvshow_id']);
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
        Schema::dropIfExists('actings');
    }
}
