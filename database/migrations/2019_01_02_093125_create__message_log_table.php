<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MessageLog', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('SendTime');
            $table->datetime('RecieveTime');
            $table->integer('StatusCode');
            $table->string('StatusText');
            $table->string('MessageTo');
            $table->string('MessageFrom');
            $table->text('MessageText');
            $table->string('MessageType');
            $table->string('MessageId');
            $table->integer('ErrorCode');
            $table->string('ErrorText');
            $table->string('Gateway');
            $table->integer('MessageParts');
            $table->text('MessagePDU');
            $table->string('Connector');
            $table->string('UserId')->nullable();
            $table->string('UserInfo')->nullable();
            $table->index(['MessageID','SendTime']);
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
        Schema::dropIfExists('MessageLog');
    }
}
