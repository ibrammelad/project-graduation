<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('salary');
            $table->string('services');
            $table->string('qualifications');
            $table->string('image');
            $table->double('lang');
            $table->double('lat');
            $table->string('from');
            $table->string('address')->nullable();
            $table->string('to');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('review')->default(1);
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('doctors');
    }
}
