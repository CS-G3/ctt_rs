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
        Schema::create('eligibility', function (Blueprint $table) {
            $table->id();
            $table->integer('eng')->default(40);
            $table->integer('dzo')->default(40);
            $table->integer('com')->default(40);
            $table->integer('acc')->default(40);
            $table->integer('bmt')->default(50);
            $table->integer('geo')->default(40);
            $table->integer('his')->default(40);
            $table->integer('eco')->default(40);
            $table->integer('med')->default(40);
            $table->integer('bent')->default(40);
            $table->integer('evs')->default(40);
            $table->integer('rige')->default(40);
            $table->integer('agfs')->default(40);
            $table->integer('mat')->default(50);
            $table->integer('phy')->default(40);
            $table->integer('che')->default(40);
            $table->integer('bio')->default(40);
            $table->timestamps(); // Created_at and updated_at columns
        });
        
        // Insert data into the 'eligibility_criteria' table
        DB::table('eligibility')->insert([
            'eng' => 40,
            'dzo' => 40,
            'com' => 40,
            'acc' => 40,
            'bmt' => 50,
            'geo' => 40,
            'his' => 40,
            'eco' => 40,
            'med' => 40,
            'bent' => 40,
            'evs' => 40,
            'rige' => 40,
            'agfs' => 40,
            'mat' => 50,
            'phy' => 40,
            'che' => 40,
            'bio' => 40,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility');
    }
};

