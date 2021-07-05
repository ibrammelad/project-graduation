<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable()->unique();
            $table->string('FCMToken')->nullable()->unique();
            $table->tinyInteger('status')->default(0);
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('showMail')->default(1);
            $table->tinyInteger('showName')->default(1);
            $table->tinyInteger('showNearly')->default(1);
            $table->tinyInteger('HaveCovid19')->default(0);
            $table->tinyInteger('susbected19')->default(0);
            $table->tinyInteger('symptoms19')->default(0);
            $table->tinyInteger('HelpUsers')->default(0);
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
