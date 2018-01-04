<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProspectbranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prospectbranch', function (Blueprint $table) {
          $table->increments('id');
          $table->string('empno')->unique();
          $table->string('prospectaddress');
          $table->string('contactperson');
          $table->string('contactnummobile');
          $table->string('contactnumlandline')->nullable();
          $table->string('neighborestablishments1');
          $table->string('neighborestablishments2')->nullable();
          $table->string('neighborestablishments3')->nullable();
          $table->string('reportedby')->nullable();
          $table->date('reporteddate')->nullable();
          $table->string('verifiedby')->nullable();
          $table->date('verifieddate')->nullable();
          $table->text('remarks')->nullable();
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
        Schema::dropIfExists('prospectbranch');
    }
}
