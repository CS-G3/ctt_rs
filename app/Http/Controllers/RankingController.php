<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\RankingCriteria;
use Illuminate\Support\Facades\DB;

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
$uniqueIdentifier = ['ranking_criteria_id' => 1];

try {
    $record = RankingCriteria::updateOrInsert($uniqueIdentifier, $filteredData);
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}

// Optionally, return a response indicating success or the updated/inserted record
return response()->json(['message' => 'Data updated or inserted successfully']);

}




public function rank(Request $request) {
    // Retrieve the selected stream (Science or Arts and Commerce)
    // $stream = $request->input('stream');

    // Fetch all students with their subjects and respective multipliers
   $students = Student::with(['RankingCriteria'])
    ->where('eligibility_status', true)
    ->whereNotNull('contact_number')
    ->get();
        foreach ($students as $student) {
            if ($student->stream === 'SCIENCE') {
                // Get the subject multipliers from the RankingCriteria table
                $subjectMultipliers = RankingCriteria::first()->toArray();
            
                if ($subjectMultipliers) {
                    // Compute the rank based on subject multipliers
                    $scienceSubjects = ['mat', 'eng', 'dzo', 'phy', 'bio', 'che'];
                    foreach ($scienceSubjects as $subject) {
                        if (array_key_exists($subject, $subjectMultipliers)) {
                            $multipliers[$subject] = $subjectMultipliers[$subject];
                        } else {
                            // Handle the case where $subject is not a valid key in $subjectMultipliers.
                            $multipliers[$subject] = 0; // Set a default value, e.g., 0.
                        }
                    }
                    //$multipliers[] = $subjectMultipliers[$scienceSubjects]; // Use the correct column for the selected stream
                    $totalMarks = 0;
                    $studentMarks = [
                        'eng' => $student->eng,
                        'mat' => $student->mat,
                        'che' => $student->che,
                        'bio' => $student->bio ?? 0,
                        'phy' => $student->phy,
                        'dzo' => $student->dzo
                    ];

                    // Calculate marks for English and Math
                    $totalMarks += $studentMarks['eng'] * $subjectMultipliers['eng'];
                    $totalMarks += $studentMarks['mat'] * $subjectMultipliers['mat'];
                    
                    // Calculate marks for other subjects (excluding English and Math)
                    $otherSubjects = array_diff_key($studentMarks, ['eng' => 0, 'mat' => 0]);
                    arsort($otherSubjects); // Sort other subjects in descending order (highest marks first)
                    
                    $otherSubjects = array_slice($otherSubjects, 0, 3); // Select the two highest marks
                    foreach ($otherSubjects as $subject => $marks) {
                        $totalMarks += $marks * $subjectMultipliers[$subject];
                    }

                    $student->total = $totalMarks;
                    $student->save();

                    $rankedStudents = DB::table('students')
                    ->select('id', 'total')
                     ->where('stream', 'SCIENCE')
                     ->whereNotNull('total')
                    ->orderBy('total', 'desc')
                    ->get();

        // Assign ranks to the students
        $rank = 1;
        foreach ($rankedStudents as $student) {
            DB::table('students')
                ->where('id', $student->id)
                ->update(['rank' => $rank]);
            $rank++;
        }
                }
            }

        //     if ($student->stream === 'ARTS' || $student->stream === 'COMMERECE') {
        //         // Get the subject multipliers from the RankingCriteria table
        //         $subjectMultipliers = RankingCriteria::first()->toArray();
            
        //         if ($subjectMultipliers) {
        //             // Compute the rank based on subject multipliers
        //             $artsComSubjects = ['bmt', 'eng', 'dzo', 'phy', 'bio', 'che'];
        //             foreach ($scienceSubjects as $subject) {
        //                 if (array_key_exists($subject, $subjectMultipliers)) {
        //                     $multipliers[$subject] = $subjectMultipliers[$subject];
        //                 } else {
        //                     // Handle the case where $subject is not a valid key in $subjectMultipliers.
        //                     $multipliers[$subject] = 0; // Set a default value, e.g., 0.
        //                 }
        //             }
        //             //$multipliers[] = $subjectMultipliers[$scienceSubjects]; // Use the correct column for the selected stream
        //             $totalMarks = 0;
        //             $studentMarks = [
        //                 'eng' => $student->eng,
        //                 'mat' => $student->mat,
        //                 'che' => $student->che,
        //                 'bio' => $student->bio ?? 0,
        //                 'phy' => $student->phy,
        //                 'dzo' => $student->dzo
        //             ];

        //             // Calculate marks for English and Math
        //             $totalMarks += $studentMarks['eng'] * $subjectMultipliers['eng'];
        //             $totalMarks += $studentMarks['mat'] * $subjectMultipliers['mat'];
                    
        //             // Calculate marks for other subjects (excluding English and Math)
        //             $otherSubjects = array_diff_key($studentMarks, ['eng' => 0, 'mat' => 0]);
        //             arsort($otherSubjects); // Sort other subjects in descending order (highest marks first)
                    
        //             $otherSubjects = array_slice($otherSubjects, 0, 3); // Select the two highest marks
        //             foreach ($otherSubjects as $subject => $marks) {
        //                 $totalMarks += $marks * $subjectMultipliers[$subject];
        //             }

        //             $student->total = $totalMarks;
        //             $student->save();

        //             $rankedStudents = DB::table('students')
        //             ->select('id', 'total')
        //              ->where('stream', 'SCIENCE')
        //              ->whereNotNull('total')
        //             ->orderBy('total', 'desc')
        //             ->get();

        // // Assign ranks to the students
        // $rank = 1;
        // foreach ($rankedStudents as $student) {
        //     DB::table('students')
        //         ->where('id', $student->id)
        //         ->update(['rank' => $rank]);
        //     $rank++;
        // }
        //         }
        //     }
        }
   

    // Calculate the rank for each student based on their subjects and multipliers
    // foreach ($students as $studentSubject) {
    //     $multiplier = $studentSubject->subjectMultiplier->$stream; // Use the correct column for the selected stream
    //     $marks = $studentSubject->marks;
    //     $rank = $marks * $multiplier;

    //     // Update and save the rank for the student subject
    //     $studentSubject->rank = $rank;
    //     $studentSubject->save();
    // }

    // // Retrieve the ranked students for displaying in the UI
    // $rankedStudents = $students->groupBy('student_id');

    // return view('rank_students', ['rankedStudents' => $rankedStudents]);
}

}
