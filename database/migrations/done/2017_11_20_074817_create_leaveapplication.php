<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveapplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('leaveapplication', function (Blueprint $table) {
          $table->increments('id');
          $table->string('empno',10);
          $table->string('alano',10)->unique();
          $table->char('reasonforabsence',2);
          $table->char('typeofabsence',2);
          $table->date('leavefrom');
          $table->date('leavethru');
          $table->string('notedby',10);
          $table->string('deptheadmgr',10);
          $table->string('admin',10);
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
        Schema::dropIfExists('leaveapplication');
    }
}
