<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users');
           $table->integer('content_id')->unsigned();
           $table->foreign('content_id')->references('id')->on('contents');
           $table->primary(['user_id','content_id']);
           $table->integer('rate')->unsigned();
            $table->timestamps();


        });
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_rate CHECK (rate BETWEEN 1 AND 10)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
