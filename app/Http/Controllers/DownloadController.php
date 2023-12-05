<?php

namespace App\Http\Controllers;

use League\Csv\Writer;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Placement;

class DownloadController extends Controller
{
    public function download(){
        $myModel = Student::all()
        ->map(function ($item) {
            // Rename 'placement_id' to 'placement' and retrieve placement name
            // $item->placement = $item->placement_id;
            $item->placement_name = Placement::find($item->placement_id)->location ?? '-';
           // Rename 'rank' to 'rankSOC'
           $item->SOC_rank = $item->rank;
           unset($item->rank);

           $item->SIDD_rank = $item->rankSIDD;
           unset($item->rankSIDD);
            // Exclude 'created_at' and 'updated_at'
            $item = $item->makeHidden(['created_at', 'updated_at', 'placement_id', 'eligibility_status', 'totalSOC', 'totalSIDD']);
    
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
            // Rename 'placement_id' to 'placement' and retrieve placement name
            // $item->placement = $item->placement_id;
            $item->placement_name = Placement::find($item->placement_id)->location ?? '-';
           // Rename 'rank' to 'rankSOC'
           $item->SOC_rank = $item->rank;
           unset($item->rank);
            $item->SIDD_rank = $item->rankSIDD;
            unset($item->rankSIDD);
            // Exclude 'created_at' and 'updated_at'
            $item = $item->makeHidden(['id', 'created_at', 'updated_at', 'placement_id', 'eligibility_status', 'totalSOC', 'totalSIDD']);
    
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
                'Content-Disposition' => 'attachment; filename="GCIT_RANK.csv"',
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
