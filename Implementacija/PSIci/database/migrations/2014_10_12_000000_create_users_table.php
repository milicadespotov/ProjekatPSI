<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 20);
            $table->string('name',20)->nullable();
            $table->string('surname', 30)->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->timestamp('birth_date')->nullable();
            $table->boolean('is_admin');
            $table->string('security_question', 100);
            $table->string('answer', 100);
            $table->string('picture_path')->nullable();
            $table->timestamp('registration_date')->useCurrent();
            $table->timestamp('admin_since')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->primary('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
