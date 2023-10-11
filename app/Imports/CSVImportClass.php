<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CSVImportClass implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Map the columns in your Excel file to your User model attributes
        return new User([
            'index_number' => $row[0],
            'date_of_birth' => $row[3],
            'stream' => $row[5],
            'supw' => $row[22],
            // Add more mappings for other attributes as needed
        ]);

}
}
