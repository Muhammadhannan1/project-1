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
            $table->unsignedBigInteger('userId');
            //$table->foreign('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->string('elderlyStatus');
            $table->unsignedBigInteger('vendorId');
            $table->foreign('vendorId')->references('userId')->on('vendors');
            //$table->foreign('vendorId')->references('id')->on('users')->onDelete('cascade');

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
