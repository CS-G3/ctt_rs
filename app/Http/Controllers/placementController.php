<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placement; // Import the Placement model

class PlacementController extends Controller
{
    // Other controller methods...

    public function add(Request $request)
    {
        // Validate the request data
        $request->validate([
            'location' => 'required',
            'time' => 'required|date',
        ]);

        // Create a new placement record
        // $placement = new Placement();
        // $placement->location = $request->input('location');
        // $placement->time = $request->input('time');
        // $placement->save();
        $student = Placement::create($request->all());


        // Redirect or return a response as needed
        // For example, you can redirect to a success page or return a JSON response
        return back();
    }

    public function delete(Placement $placement)
    {
        $placement->delete();

        // Redirect or return a response after deletion
        return back();
    }
}