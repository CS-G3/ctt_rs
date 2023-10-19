<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function add(Request $request)
    {
        // Validate the input data
        $request->validate([
            'fileURL' => 'required',
            'archivedDate' => 'required|date',
            'archivedBy' => 'required',
        ]);

        // Create a new Archive model and save it to the database
        $archive = new Archive;
        $archive->fileURL = $request->input('fileURL');
        $archive->archivedDate = $request->input('archivedDate');
        $archive->archivedBy = $request->input('archivedBy');
        $archive->save();

        // Optionally, you can redirect to a view or return a response
        // return redirect('/archives')->with('success', 'Record added successfully');
        return back();
    }

    public function delete(Archive $archive )
    {
        $archive ->delete();

        // Redirect or return a response after deletion
        return back();
    }
}
