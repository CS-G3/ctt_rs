<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{

    public function loginForm()
    {
        return view('std_login');
    }

    // public function index()
    // {
    //     $students = Student::all();
    //     return view('std', compact('students'));
    // }

    public function login(Request $request)
    {
        // Validate the login data
        $request->validate([
            'index_number' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        $indexNumber = $request->input('index_number');
        $dateOfBirth = $request->input('date_of_birth');

        // echo $indexNumber;
        // echo $dateOfBirth;

        // Check if the student exists in the database
        $student = Student::where('index_number', $indexNumber)
            ->where('date_of_birth', $dateOfBirth)
            ->first();

        if ($student) {
            // Student is authenticated, you can store the student's ID in the session
            // return back()->with('success', 'Login successful.');
            Session::put('student_id', $student->id);
            return redirect('/student/dashboard');
        } else {
            return back()->with('error', 'No user found.');
        }
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->validationRules($id));

        $student = Student::findOrFail($id);
        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function register(Request $request)
    {
        // Validate student registration data
        $request->validate([
            // Define validation rules here for student registration fields
        ]);

        // Create and save a new student record using the Student model
        $student = Student::create($request->all());

        // Redirect or perform any other action after student registration
        // return redirect('/login'); // Redirect to the student list or another page
    }

    public function updateByIndex(Request $request)//student apply for ctt
    {
        $indexNumber = $request->input('index_number');
    
        try {
            // Find the student by index number
            $student = Student::where('index_number', $indexNumber)->firstOrFail();

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error($e);
            return back()->with('error', 'Invalid index number.')
                        ->with('index_number', $indexNumber);
            // return redirect()->route('register_user')->with('error', 'Error updating student');
        }

            // echo $student;

            echo $request->contact_number;

            $id = $student->id;
            echo "id",$id;
            echo "eligibilty status: ",$student->eligibility_status;

            $eligibility_status = $student->eligibility_status;

            // Update the student data with validation rules
            // $validatedData = $request->validate($this->validationRules($id));
            // $student = Student::findOrFail($id);
            // $student->update($validatedData);

            if ($eligibility_status) {
                 $validatedData = $request->validate([
                'contact_number' => 'required|regex:/^\d{8}$/',//required length of contact number is 8
            ]);

            echo "validate", json_encode($validatedData);

            if ($validatedData) $student->update(['contact_number'=>$request->contact_number]);

            // Session::flash('success', 'update successful.'); // Set success message
            return back()->with('success', 'You have successful applied.')
                        ->with('index_number', $indexNumber);

            } else {
                // Session::flash('error', 'Please try again.'); // Set error message
                return back()->with('error', 'You are not eligible for GCIT CTT.')
                            ->with('index_number', $indexNumber);

            }

            // $validatedData = $request->validate($this->validationRules($student->id)); // assuming you have 'id' as the primary key
            // $student->update($validatedData);
    
            // return redirect()->route('register_user')->with('success', 'Student updated successfully');

    }
    
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    protected function validationRules($id = null)
    {
        return [
            'index_number' => 'required|integer|unique:students,index_number,' . $id,
            'date_of_birth' => 'required|date',
            'contact_number' => 'nullable|string',
            'placement_id' => 'nullable|integer',
            'stream' => 'required|string|max:255',
            'supw' => 'required|string|max:1',
            'eligibility_criteria_id' => 'nullable|integer',
            'eng' => 'nullable|integer',
            'dzo' => 'nullable|integer',
            'com' => 'nullable|integer',
            'acc' => 'nullable|integer',
            'bmt' => 'nullable|integer',
            'geo' => 'nullable|integer',
            'his' => 'nullable|integer',
            'eco' => 'nullable|integer',
            'med' => 'nullable|integer',
            'bent' => 'nullable|integer',
            'evs' => 'nullable|integer',
            'rige' => 'nullable|integer',
            'agfs' => 'nullable|integer',
            'mat' => 'nullable|integer',
            'phy' => 'nullable|integer',
            'che' => 'nullable|integer',
            'bio' => 'nullable|integer',
            'eligibility_status' => 'nullable|boolean',
            'rank' => 'nullable|integer',
        ];
    }

    public function logout(Request $request)
    {
        Session::flush(); // Flush the session
        // Auth::logout(); // Log the user out

        return Redirect('student-login');
    }
}
