<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePbf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prospectivebranch', function (Blueprint $table) {
          $table->increments('id');
          $table->string('empno',10);
          $table->string('pbfno',10)->unique();
          $table->string('address',90);
          $table->string('contactperson',45);
          $table->string('contactperson_mobile',35);
          $table->string('contactperson_landline',35);
          $table->string('verifiedby',10)->nullable();
          $table->date('verifieddate')->nullable();
          $table->string('remarks',100);
          $table->string('authstatus',1)->default('P');
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
        Schema::dropIfExists('prospectivebranch');
    }
}
