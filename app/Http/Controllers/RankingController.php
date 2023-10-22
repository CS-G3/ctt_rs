<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RankingCriteria;

class RankingController extends Controller
{
    public function updateOrCreateRankingCriteria(Request $request)
{
    $data = $request->all();

// Define the list of columns that you want to insert
$columnsToInsert = [
    'eng', 'dzo', 'com', 'acc', 'bmt', 'geo', 'his', 'eco', 'med', 'bent', 'evs', 'rige', 'agfs', 'mat', 'phy', 'che', 'bio'
    // Add other columns here
];

// Initialize an empty array to hold the filtered data
$filteredData = [];

// Loop through the columns you want to insert and add them to $filteredData
foreach ($columnsToInsert as $column) {
    if (isset($data[$column])) {
        $filteredData[$column] = $data[$column];
    }
}

// Find the record based on a unique identifier (e.g., ranking_criteria_id)
$uniqueIdentifier = ['ranking_criteria_id' => $data['ranking_criteria_id']];

try {
    $record = RankingCriteria::updateOrInsert($uniqueIdentifier, $filteredData);
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}

// Optionally, return a response indicating success or the updated/inserted record
return response()->json(['message' => 'Data updated or inserted successfully']);

}
}
