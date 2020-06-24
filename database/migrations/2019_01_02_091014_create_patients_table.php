<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('surname');
            $table->integer('gender_id');
            $table->date('dateofbirth')->nullable();
            $table->string('artnumber')->unique();
            $table->string('primarycell');
            $table->string('secondarycell')->nullable();
            $table->string('messagelanguage_id');
            $table->string('messagemode_id');
            $table->integer('activestatus_id');
            $table->integer('healthunit_id');
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
