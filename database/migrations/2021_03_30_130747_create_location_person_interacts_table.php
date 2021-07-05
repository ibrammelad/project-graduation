<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationPersonInteractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_person_interacts', function (Blueprint $table) {
            $table->id();
            $table->double('lang');
            $table->double('lat');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('user_1');
            $table->unsignedBigInteger('user_2');
          //  $table->foreign('user_1')->on('users')->references('id');
           // $table->foreign('user_2')->on('users')->references('id');

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
        Schema::dropIfExists('location_person_interacts');
    }
}
