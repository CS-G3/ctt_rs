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
        Schema::create('registration_period', function (Blueprint $table) {
            $table->id();
            $table->date('startDate'); // Add startDate column
            $table->date('endDate');   // Add endDate column
            $table->string('STATUS');  // Add STATUS column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_period');
    }
};
