<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpmaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('empmaster', function (Blueprint $table) {
          $table->increments('id');
          $table->string('s_employid', 10)->unique();
          $table->string('s_lastname', 45);
          $table->string('s_frstname', 45);
          $table->string('s_middname', 45)->nullable();
          $table->string('s_emplstat', 1)->nullable();
          $table->string('s_brnccode', 3);
          $table->string('s_paytypex', 2);
          $table->string('s_posicode', 3)->nullable();
          $table->string('s_ratecode', 1)->nullable();
          $table->string('s_employno', 10)->nullable();
          $table->date('d_sepadate')->nullable();
          $table->string('s_tinumber', 11)->nullable();
          $table->string('s_ssnumber', 12)->nullable();
          $table->string('s_hdmfidno', 15)->nullable();
          $table->string('s_medinmbr', 14)->nullable();
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
        Schema::dropIfExists('empmaster');
    }
}
