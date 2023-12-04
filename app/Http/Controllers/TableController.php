<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TableController extends Controller
{
    public function loadTable($table)
    {
        // Load data for the selected table from the database
        if ($table == "table1") {
            $data = Student::whereNotNull('rank')->orderBy('rank')->paginate(8); // Sort by 'rank'
        } else {
            $data = Student::whereNotNull('rankSIDD')->paginate(8); // Adjust the number based on your preference
        }

        // Return the HTML view for the table
        return view('manager.Partials.' . $table, ['data' => $data]);
    }

    // public function loadTable_soc()
    // {
    //     // Load data for the selected table from the database
    //         $data = Student::whereNotNull('rank')->paginate(8); // Adjust the number based on your preference
    //         $data = $data->sortBy('rank');

    //     // Return the HTML view for the table
    //     return view('manager/rank', compact('data'));
    // }
}