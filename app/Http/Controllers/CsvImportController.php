<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\CSVImportClass;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CsvImportController extends Controller
{
//     public function showUploadForm()
// {
//     return view('import'); // Replace 'upload' with the name of your Blade view file
// }

    public function showUploadForm()
    {
        return view('import', ['progress' => 0]);
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx',
        ]);
    
        // Get the uploaded file
        $file = $request->file('file');
        try{
        // Check if it's an Excel file and convert to CSV if necessary
        if ($file->getClientOriginalExtension() === 'xlsx' || $file->getClientOriginalExtension() === 'xls') {
            $csvData = Excel::toArray(new CSVImportClass, $file);
            // $array = array_shift($csvData);
            // $array = array_merge(...$csvData);
            $csvRows = [];

    foreach ($csvData as $array) {
        foreach ($array as $row) {
            $csvRow = implode(',', $row);
            $csvRows[] = $csvRow;
        }
    }

            // $csvData = implode("\n", $csvRows);
            $csvData=$csvRows;
            
        } else {
            $csvData = file($file);
        } 

        Student::truncate();

        // error_log(print_r($csvData, true));
        // error_log(print_r($csvData, true));
        // Process and store data in the database
        foreach ($csvData as $key => $row) {
            if ($key === 0) {
                // Skip the header row
                continue;
            }
    
            $data = str_getcsv($row, ',');
            // error_log(print_r($data, true));
            // Create an associative array to store attribute name-value pairs
            $attributes = [];
    
            // Map the fixed columns to attributes
            $attributes['index_number'] = $data[0];
            $attributes['name'] = $data[1];
            $attributes['date_of_birth'] = $data[3];
            $attributes['stream'] = $data[5];
            $attributes['supw'] = $data[22];
    
            // Loop through the subjects (SUB) and marks (MKS) columns
            for ($i = 10; $i <= 21; $i += 2) {
                $subject = trim($data[$i]);
                $marks = (int)$data[$i + 1];
    
                // Map subject (SUB) to the corresponding attribute
                switch ($subject) {
                    case 'ENG':
                        $attributes['eng'] = $marks;
                        break;
                    case 'DZO':
                        $attributes['dzo'] = $marks;
                        break;
                    case 'COM':
                        $attributes['com'] = $marks;
                        break;
                    case 'ACC':
                        $attributes['acc'] = $marks;
                        break;
                    case 'BMT':
                        $attributes['bmt'] = $marks;
                        break;
                    case 'GEO':
                        $attributes['geo'] = $marks;
                        break;
                    case 'HIS':
                        $attributes['his'] = $marks;
                        break;
                    case 'ECO':
                        $attributes['eco'] = $marks;
                        break;
                    case 'MED':
                        $attributes['med'] = $marks;
                        break;
                    case 'BENT':
                        $attributes['bent'] = $marks;
                        break;
                    case 'EVS':
                        $attributes['evs'] = $marks;
                        break;
                    case 'RIGE':
                        $attributes['rige'] = $marks;
                        break;
                    case 'AGFS':
                        $attributes['agfs'] = $marks;
                        break;
                    case 'MAT':
                        $attributes['mat'] = $marks;
                        break;
                    case 'PHY':
                        $attributes['phy'] = $marks;
                        break;
                    case 'CHE':
                        $attributes['che'] = $marks;
                        break;
                    case 'BIO':
                        $attributes['bio'] = $marks;
                        break;   
                    default:
                        // Handle unrecognized subjects here, if needed
                        break;
                }
            }
    
            // Create a new User instance with the dynamically mapped attributes
            Student::create($attributes);
        }
        return redirect()->back()->with('success', 'Data imported successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e);
    }
    }
    

}
