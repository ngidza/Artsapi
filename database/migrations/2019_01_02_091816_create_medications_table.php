<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('medication_id')->default(1);
            $table->string('stage')->nullable();
            $table->integer('value')->nullable();
            $table->integer('dosage_id')->default(1);         
            $table->string('pills')->nullable();  
            $table->string('effects_id')->default(1);  
            $table->string('healthunit_id')->default(1); 
            $table->dateTime('nextcolldate');
            $table->string('notes')->nullable(); 
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
        Schema::dropIfExists('medications');
    }
}
