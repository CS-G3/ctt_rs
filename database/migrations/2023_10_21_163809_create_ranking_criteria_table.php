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
        Schema::create('ranking_criteria', function (Blueprint $table) {
            $table->id();
            $table->integer('ranking_criteria_id')->default(1);
            $table->integer('eng')->default(0);
            $table->integer('dzo')->default(0);
            $table->integer('com')->default(0);
            $table->integer('acc')->default(0);
            $table->integer('bmt')->default(0);
            $table->integer('geo')->default(0);
            $table->integer('his')->default(0);
            $table->integer('eco')->default(0);
            $table->integer('med')->default(0);
            $table->integer('bent')->default(0);
            $table->integer('evs')->default(0);
            $table->integer('rige')->default(0);
            $table->integer('agfs')->default(0);
            $table->integer('mat')->default(0);
            $table->integer('phy')->default(0);
            $table->integer('che')->default(0);
            $table->integer('bio')->default(0);
            $table->integer('socT')->default(0);
            $table->integer('siddT')->default(0);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_criteria');
    }
};
