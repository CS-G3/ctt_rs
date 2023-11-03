<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RegistrationPeriod;

class RegistrationPeriodController extends Controller
{
    // ...other controller functions...

    public function add(Request $request)
    {
        $data = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'STATUS' => 'required|string',
        ]);

        RegistrationPeriod::create($data);
        return back();

    }

    public function delete(RegistrationPeriod $registrationPeriod )
    {
        $registrationPeriod ->delete();

        // Redirect or return a response after deletion
        return back();
    }
}
