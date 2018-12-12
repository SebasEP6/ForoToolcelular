<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('role', ['member', 'privilege', 'moderator', 'support', 'admin']);
            $table->string('user')->unique();
            $table->string('picture')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->string('country')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('website_url')->nullable();
            $table->string('slogan')->nullable();
            $table->enum('notify', ['y', 'n'])->default('y');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
