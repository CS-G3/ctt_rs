<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Student;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function add(Request $request)
    {
        $fileName = $request->input('file_name', 'default_file_name');
        $archives = Student::all();
    
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
            'fileURL' => $csvFilePath,
            'archivedDate' => now(), // Assuming you want to store the current date and time
            'archivedBy' => auth()->user()->name, // Assuming you are using Laravel's built-in authentication
        ]);
        $archive->save();
    
        // Provide a download link or any other response as needed
        return response()->json(['message' => "CSV file saved as {$fileName}.csv"]);
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
}
