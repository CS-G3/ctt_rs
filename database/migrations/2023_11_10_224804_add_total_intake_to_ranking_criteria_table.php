<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTotalIntakeToRankingCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranking_criteria', function (Blueprint $table) {
            $table->integer('total_intake')->nullable();
            // Replace 'existing_column_name' with the name of the existing column after which you want to add the new column
        });

        // Inserting a specific value (100) into the 'total_intake' column for the first row
        DB::table('ranking_criteria')->updateOrInsert(
            ['id' => 1], // Assuming 'id' is the primary key of your table
            ['total_intake' => 100]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranking_criteria', function (Blueprint $table) {
            $table->dropColumn('total_intake');
        });
    }
}
