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
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('token');
            $table->tinyInteger('status')->default(1);
            $table->string('image');
            $table->tinyInteger('showMail')->default(1);
            $table->tinyInteger('showName')->default(1);
            $table->tinyInteger('showNearly')->default(1);
            $table->tinyInteger('HaveCovid19')->default(1);
            $table->tinyInteger('HelpUsers')->default(1);
            $table->unsignedBigInteger('doctor_details_id');
            $table->unsignedBigInteger('nurse_details_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

//            $table->foreign('doctor_details_id')->on('doctors')->references('id')->onDelete('cascade');
//            $table->foreign('nurse_details_id')->on('nurses')->references('id')->onDelete('cascade');


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
