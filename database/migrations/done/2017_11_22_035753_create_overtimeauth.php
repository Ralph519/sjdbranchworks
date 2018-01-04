<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimeauth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('overtimeauth', function (Blueprint $table) {
          $table->increments('id');
          $table->string('empno',10);
          $table->string('otano',10)->unique();
          $table->string('otsched',30);
          $table->char('reason',2);
          $table->string('deptheadmgr',10)->nullable();
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
        Schema::dropIfExists('undertimerequest');
    }
}
