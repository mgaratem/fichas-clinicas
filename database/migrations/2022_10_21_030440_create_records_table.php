<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->json('anamnesis')->nullable();
            $table->bigInteger('patient_id')->nullable();
            $table->bigInteger('professional_id')->nullable();
            $table->timestamps();
        });

        Schema::table('records', function($table){
            $table->foreign('professional_id')
                ->references('id')->on('users'); 
            $table->foreign('patient_id')
                ->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};
