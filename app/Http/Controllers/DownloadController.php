<?php

namespace App\Http\Controllers;

use League\Csv\Writer;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(){
        $myModel = Student::all()->map(function ($item) {
            // Exclude 'created_at' and 'updated_at'
            $item = $item->makeHidden(['created_at', 'updated_at']);
        
            // Replace null values with '-'
            foreach ($item->getAttributes() as $key => $value) {
                $item->$key = $value ?? '-';
            }
        
            return $item;
        });
        
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

            $headers['Content-Length'] = strlen($csvContent);
        
            // Stream the CSV file to the browser
            return response()->stream(
                function () use ($csvContent) {
                    echo $csvContent;
                },
                200,
                $headers
            );
        } catch (\Exception $e) {
            // Handle exceptions if any
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function downloadResultOnly(){

        $myModel = Student::whereNotNull('rank')
        ->orWhereNotNull('rankSIDD')
        ->get()
        ->map(function ($item) {
            // Exclude 'created_at' and 'updated_at'
            $item = $item->makeHidden(['created_at', 'updated_at']);
        
            // Replace null values with '-'
            foreach ($item->getAttributes() as $key => $value) {
                $item->$key = $value ?? '-';
            }
        
            return $item;
        });
        
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

            $headers['Content-Length'] = strlen($csvContent);
        
            // Stream the CSV file to the browser
            return response()->stream(
                function () use ($csvContent) {
                    echo $csvContent;
                },
                200,
                $headers
            );
        } catch (\Exception $e) {
            // Handle exceptions if any
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
