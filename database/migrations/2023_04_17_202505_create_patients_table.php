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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');

            $table->foreign('userId')->references('id')->on('users');
            $table->integer('code');
            $table->string('elderlyStatus');
            $table->unsignedBigInteger('vendorId');
            $table->foreign('vendorId')->references('userId')->on('vendors');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
