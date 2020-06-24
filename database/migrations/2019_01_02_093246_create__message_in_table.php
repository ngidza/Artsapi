<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MessageIn', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('SendTime');
            $table->datetime('RecieveTime');
            $table->string('MessageFrom');
            $table->string('MessageTo');
            $table->string('SMSC');
            $table->text('MessageText');
            $table->string('MessageType');
            $table->integer('MessageParts');
            $table->text('MessagePDU');
            $table->string('Gateway');
            $table->string('UserID')->nullable();
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
        Schema::dropIfExists('MessageIn');
    }
}
