<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MessageOut', function (Blueprint $table) {
            $table->increments('id');
            $table->string('messageto');
            $table->string('messagefrom')->nullable();
            $table->text('messagetext');
            $table->string('messagetype')->nullable();
            $table->string('gateway')->nullable();
            $table->string('userid')->nullable();
            $table->text('userinfo')->nullable();
            $table->integer('priority')->nullable();
            $table->date('scheduled')->nullable();
            $table->integer('validityperiod')->nullable();
            $table->tinyinteger('issent')->default(0);
            $table->tinyinteger('isread')->default(0);
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
        Schema::dropIfExists('MessageOut');
    }
}
