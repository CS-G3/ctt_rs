<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function add(Request $request)
    {
        $fileName = $request->input('file_name', 'default_file_name');
        $archives = Student::all()->map(function ($item) {
            // Exclude 'created_at' and 'updated_at'
            $item = $item->makeHidden(['created_at', 'updated_at']);
        
            // Replace null values with '-'
            foreach ($item->getAttributes() as $key => $value) {
                $item->$key = $value ?? '-';
            }
        
            return $item;
        });
        // Convert the data to CSV format
        $csvContent = implode(',', array_keys($archives->first()->toArray())) . PHP_EOL; // Header
    
        foreach ($archives as $row) {
            $csvContent .= implode(',', $row->toArray()) . PHP_EOL;
        }
    
        // Save the CSV file to the local machine
        $folderName = 'archive';

        // Save the CSV file to the local machine inside the "archive" folder
        $csvFilePath = storage_path("app/public/{$folderName}/{$fileName}.csv");
        
        file_put_contents($csvFilePath, $csvContent);

        $archive = new Archive([
            'name' =>$fileName,
            'fileURL' => $csvFilePath,
            'archivedDate' => now(), // Assuming you want to store the current date and time
            'archivedBy' => auth()->user()->name, // Assuming you are using Laravel's built-in authentication
        ]);
        $archive->save();
    
        // Provide a download link or any other response as needed
        // return response()->json(['message' => "CSV file saved as {$fileName}.csv"]);
        return back()->with('success', 'Data archived.');

    }

    public function showArchive()
{
    // Fetch all records from the Archive model
    $archives = Archive::all();

    // Return the view with the archive data
    return view('manager/archive', compact('archives'));
}

public function deleteArchive($id)
{
    $archive = Archive::find($id);

    if ($archive) {
        unlink($archive->fileURL);

        $archive->delete();
        return redirect()->route('archive.view')->with('success', 'Archive record deleted successfully.');
    } else {
        return redirect()->route('archive.view')->with('error', 'Archive record not found.');
    }
}

public function download($id)
{
    try {
        // Retrieve the specific model instance based on the ID
        $model = Archive::find($id);

        // Check if the model instance exists
        if ($model) {
            // Get the file path from the model
            $filePath = $model->fileURL;
            
            $fullPath = storage_path('app/public/archive/' . $model->fileURL);
            // Check if the file exists in the public disk
            if (file_exists($filePath)) {
                // Read the content of the CSV file
                $csvContent = file_get_contents($filePath);

                // Set the headers to force a download
                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
                ];

                // Stream the CSV file to the browser
                return response()->stream(
                    function () use ($csvContent) {
                        echo $csvContent;
                    },
                    200,
                    $headers
                );
            } else {
                // Handle the case where the file does not exist
                return response()->json(['error' => 'File not found'], 404);
            }
        } else {
            // Handle the case where the record is not found
            return response()->json(['error' => 'Archive record not found'], 404);
        }
    } catch (\Exception $e) {
        // Handle exceptions if any
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function addRank(Request $request)
{
    $fileName = $request->input('file_name', 'default_file_name');

    // Fetch only students with a rank
    $archives = Student::whereNotNull('rank')
    ->orWhereNotNull('rankSIDD')
    ->get()->map(function ($item) {
        // Exclude 'created_at' and 'updated_at'
        $item = $item->makeHidden(['created_at', 'updated_at']);

        // Replace null values with '-'
        foreach ($item->getAttributes() as $key => $value) {
            $item->$key = $value ?? '-';
        }

        return $item;
    });

    // Check if there are any students with a rank
    if ($archives->isEmpty()) {
        return back()->with('error', 'No students with rank found.');
    }

    // Convert the data to CSV format
    $csvContent = implode(',', array_keys($archives->first()->toArray())) . PHP_EOL; // Header

    foreach ($archives as $row) {
        $csvContent .= implode(',', $row->toArray()) . PHP_EOL;
    }

    // Save the CSV file to the local machine
    $folderName = 'archive';

    // Save the CSV file to the local machine inside the "archive" folder
    $csvFilePath = storage_path("app/public/{$folderName}/{$fileName}.csv");

    file_put_contents($csvFilePath, $csvContent);

    $archive = new Archive([
        'name' => $fileName,
        'fileURL' => $csvFilePath,
        'archivedDate' => now(), // Assuming you want to store the current date and time
        'archivedBy' => auth()->user()->name, // Assuming you are using Laravel's built-in authentication
    ]);
    $archive->save();

    return back()->with('success', 'Data archived.');
}



}

