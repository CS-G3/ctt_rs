<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eligibility;
class eligibilityController extends Controller
{

    public function index()
    {
        $eligibility = Eligibility::all();

        return view('/manager/dashboard', compact('eligibility'));
    }

    public function edit($id)
    {
        // Fetch the eligibility data by ID
        $eligibility = Eligibility::find($id);

        if (!$eligibility) {
            // Handle the case where eligibility data is not found
        }

        // Load the edit view with the eligibility data
        return view('eligibility.edit', compact('eligibility'));
    }

    public function update(Request $request)
    {
        $eligibility = Eligibility::where('id', $request->input('id'))->first(); // Fetch the id of the first eligibility record

        // Update the eligibility data
        // $eligibility->update($validatedData);

        if ($eligibility) {
            $eligibility->update([
                'eng' => $request->input('eng'),
                'dzo' => $request->input('dzo'),
                'phy' => $request->input('phy'),
                'che' => $request->input('che'),
                'bio' => $request->input('bio'),
                'mat' => $request->input('mat'),
                'com' => $request->input('com'),
                'acc' => $request->input('acc'),
                'geo' => $request->input('geo'),
                'his' => $request->input('his'),
                'eco' => $request->input('eco'),
                'med' => $request->input('med'),
                'bent' => $request->input('bent'),
                'evs' => $request->input('evs'),
                'rige' => $request->input('rige'),
                'agfs' => $request->input('agfs'),
            ]);
        
        }

        // Redirect back with a success message or to a different route
        return back()->with('success', 'Eligibility info updated.');
    }

    public function show($id)
    {
        $eligibility = Eligibility::find($id);

        if (!$eligibility) {
            // Handle the case where eligibility data is not found
        }

        return view('eligibility.show', compact('eligibility'));
    }

}
