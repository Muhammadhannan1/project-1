<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('careTakerId');
            $table->foreign('careTakerId')->references('userId')->on('caretakers');
            $table->unsignedBigInteger('patientId');
            $table->foreign('patientId')->references('userId')->on('patients');
            $table->string('relationName');
            $table->integer('otp');
            $table->string('status');
            $table->string('careTakerName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
