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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paternal_last_name');
            $table->string('maternal_last_name')->nullable();
            $table->string('rut')->unique();
            $table->string('gender');
            $table->date('birth_date');
            $table->string('occupation');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('email')->unique();
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
};
