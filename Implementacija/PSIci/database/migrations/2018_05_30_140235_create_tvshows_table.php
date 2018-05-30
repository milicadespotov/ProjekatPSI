<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvshowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('tvshows', function (Blueprint $table) {
            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents');
           $table->string('country', 30)->nullable();
           $table->string('language', 20)->nullable();
           $table->integer('length')->unsigned()->nullable();
           $table->timestamp('end_date')->nullable();
           $table->integer('number_of_episodes')->unsigned()->nullable();

            $table->timestamps();
            $table->primary('content_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tvshows');
    }
}
