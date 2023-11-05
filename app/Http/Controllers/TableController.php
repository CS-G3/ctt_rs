<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function loadTable($table)
{
    // Load data for the selected table from the database
    if ($table == "table1"){
        $data = Student::whereNotNull('rank')
        ->get();
    } else {
    $data = Student::whereNotNull('rankSIDD')
    ->get();}

    // Return the HTML view for the table
    return view('manager.Partials.'.$table, ['data' => $data]);
}
}
