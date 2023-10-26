<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->bigInteger('index_number')->unique();

            $table->string('contact_number', 20)->nullable();
            $table->integer('placement_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('stream', 255);
            $table->char('supw', 1);
            $table->integer('eligibility_criteria_id')->nullable();
            $table->integer('eng')->nullable();
            $table->integer('dzo')->nullable();
            $table->integer('com')->nullable();
            $table->integer('acc')->nullable();
            $table->integer('bmt')->nullable();
            $table->integer('geo')->nullable();
            $table->integer('his')->nullable();
            $table->integer('eco')->nullable();
            $table->integer('med')->nullable();
            $table->integer('bent')->nullable();
            $table->integer('evs')->nullable();
            $table->integer('rige')->nullable();
            $table->integer('agfs')->nullable();
            $table->integer('mat')->nullable();
            $table->integer('phy')->nullable();
            $table->integer('che')->nullable();
            $table->integer('bio')->nullable();
            $table->boolean('eligibility_status')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('total')->nullable();
            // $table->boolean('is_applied')->default(false);
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
