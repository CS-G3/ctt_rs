<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Placement;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function loginForm()
    {
        return view('student/std_login');
    }

    // public function index()
    // {
    //     $students = Student::all();
    //     return view('std', compact('students'));
    // }

    public function show($id) {
        $student = Student::findOrFail($id);
        $placement = Placement::all(); // Fetch the first eligibility record

        return view('student/std_dashboard', compact('student', 'placement'));
    }

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
        ->where('eligibility_status', true) //student should be eligible 
        ->whereNotNull('contact_number') //not null contact num = applied
        ->first();

        if ($student) {
            // Student is authenticated, you can store the student's ID in the session
            // return back()->with('success', 'Login successful.');
            Session::put('student_id', $student->id);
            // return redirect('/student/student_id/dashboard');
            $redirectURL = route('student.show', ['student_id' => $student->id]);
            return redirect($redirectURL);
        } else {
            return back()->with('error', 'No user found.');
        }
    }

    // //fetch particular student details
    // public function getStudentByIndex(Request $request)
    // {
    //     // Validate the input
    //     $request->validate([
    //         'index_number' => 'required|string',
    //     ]);

    //     $indexNumber = $request->input('index_number');

    //     // Find the student by index number
    //     $student = Student::where('index_number', $indexNumber)->first();

    //     if ($student) {
    //         // Student found, you can return the student details or perform any other action
    //         return view('student.student_details', compact('student'));
    //     } else {
    //         // Student not found
    //         return back()->with('error', 'Student not found for the given index number.');
    //     }
    // }

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
        try {
    
            $student = Student::where('id', $id)->firstOrFail();

            $validatedData = $request->validate([
                'contact_number' => 'required|regex:/^\d{8}$/',//required length of contact number is 8
            ]);

            if ($validatedData) $student->update(['contact_number'=>$request->contact_number]);

                return back()->with('success', 'Updated successful.');
    
        } catch (\Exception $e) {
            // Handle the exception, such as displaying an error message or logging the error.
            \Log::error($e);
            return back()->with('error', $e);
        }
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

            //get colnames without nulll values
            //then compare the none null col with eligibilty table col
            //return tru if all greater the min marks
            //todo

            // Define the list of columns to compare
            $columnsToCompare = ['eng', 'dzo', 'com', 'acc', 'bmt', 'geo', 'his', 'eco', 'med', 'bent', 'evs', 'rige', 'agfs', 'mat', 'phy', 'che', 'bio'];

            // Retrieve the first row of the "eligibility" table
            $eligibilityRow = DB::table('eligibility')->first();

            if (!$eligibilityRow) {
                // Handle the case where there's no data in the "eligibility" table.
                echo "No eligibility data found in the table.\n";
            } else {
                // Retrieve all columns from the "students" table
                // $studentData = DB::table('students')->select($columnsToCompare)->get();
               
                //return $studentData = index_number
                $studentData = DB::table('students')
                ->select($columnsToCompare)
                ->where('index_number', $indexNumber)
                ->first();
    
                // Loop through each row in the "eligibility" table
                $isEligible = true;

                foreach ($columnsToCompare as $column) {
                    $studentValue = $studentData->$column;
                    $eligibilityValue = $eligibilityRow->$column;

                    echo $studentValue,"+";

                    if (!is_null($studentValue) && !is_null($eligibilityValue) && $studentValue < $eligibilityValue) {
                        // If any column is not greater, the student is not eligible
                        $isEligible = false;
                        break;
                    }
                }

                if ($isEligible) {
                    echo "Student is eligible\n";
                    echo $request->contact_number;
                    echo $student;
                    
                    $validatedData = $request->validate([
                        'contact_number' => 'required|regex:/^\d{8}$/',//required length of contact number is 8
                    ]);

                    echo "validate", json_encode($validatedData);

                    if ($validatedData) $student->update(['contact_number'=>$request->contact_number]);

                    $student->update(['eligibility_status'=> true]);
                // // Session::flash('success', 'update successful.'); // Set success message
                return back()->with('success', 'You have successful applied.')
                            ->with('index_number', $indexNumber);
            
                } else {
                    echo "Student is not eligible\n";
                    $student->update(['eligibility_status'=> false]);
                    return back()->with('error', 'You are not eligible for GCIT CTT.')
                            ->with('index_number', $indexNumber);
                }
            }

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error($e);
            return back()->with('error', 'Internal error.');
        }

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
