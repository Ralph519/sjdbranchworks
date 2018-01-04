<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrmsposition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('hrmsposition', function (Blueprint $table) {
          $table->increments('id');
          $table->string('s_posicode', 3)->unique();
          $table->string('s_posidesc', 40);
          $table->string('s_jobgrade', 2);
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
        Schema::dropIfExists('hrmsposition');
    }
}
