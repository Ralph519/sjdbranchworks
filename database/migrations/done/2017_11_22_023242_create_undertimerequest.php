<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUndertimerequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('undertimerequest', function (Blueprint $table) {
          $table->increments('id');
          $table->string('empno',10);
          $table->string('urfno',10)->unique();
          $table->char('reason',2);
          $table->date('undertimefrom');
          $table->date('undertimethru');
          $table->string('notedby',10)->nullable();
          $table->string('deptheadmgr',10)->nullable();
          $table->string('admin',10)->nullable();
          $table->string('requeststatus',1)->default('P');
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
