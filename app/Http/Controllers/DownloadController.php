<?php

namespace App\Http\Controllers;

use League\Csv\Writer;
use App\Models\Student;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(){
        $myModel = Student::all();
        try {
        // Convert the data to CSV format
        $csvData = [];
        $csvData[] = array_keys($myModel->first()->toArray()); // Header
        foreach ($myModel as $row) {
            $csvData[] = $row->toArray();
        }
    
        // Create CSV file content
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . PHP_EOL;
        }
    
        // Set the headers to force a download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="GCIT_RANK_ARCHIVE.csv"',
        ];
    
        // Stream the CSV file to the browser
        return response()->stream(
            function () use ($csvContent) {
                echo $csvContent;
            },
            200,
            $headers
        );
    } catch (\Exception $e) {
        Log::error('Error downloading CSV: ' . $e->getMessage());
        // Handle the error as needed
    }
    }

}
