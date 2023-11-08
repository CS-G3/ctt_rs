<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RegistrationPeriod;

class RegistrationPeriodController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            // 'STATUS' => 'required|string',
        ]);
    
        // Try to find a record by its existence
        $existingRecord = RegistrationPeriod::firstOrNew();
    
        // Fill the existing record or a new instance with the provided data
        $existingRecord->fill($data);
    
        // Save the record to the database
        $existingRecord->save();
    
        return back()->with('success', 'Date updated successfully');
    }

    public function delete(RegistrationPeriod $registrationPeriod )
    {
        $registrationPeriod ->delete();

        // Redirect or return a response after deletion
        return back();
    }
}
