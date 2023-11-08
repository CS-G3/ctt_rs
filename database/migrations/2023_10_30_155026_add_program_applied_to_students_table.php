<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgramAppliedToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->enum('program_applied', ['soc', 'sidd', 'both'])->nullable();
            // Replace 'existing_column' with the name of the existing column after which you want to place this new column.
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('program_applied');
        });
    }
}
