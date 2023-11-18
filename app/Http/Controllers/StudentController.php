<?php

namespace App\Http\Controllers;

use App\Models\RankingCriteria;
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

    // public function show($id) {
    //     $student = Student::findOrFail($id);
    //     $placement = Placement::all(); // Fetch the first eligibility record

    //     return view('student/std_dashboard', compact('student', 'placement'));
    // }

    public function show() {
        $student_id = Session::get('student_id');
        $student = Student::findOrFail($student_id);
        $placement = Placement::all(); // Fetch the first eligibility record
        $total_intake = RankingCriteria::first()->total_intake; //fetch thte total intake number

        return view('student/std_dashboard', compact('student', 'placement', 'total_intake'));
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
    
        $student = Student::where('index_number', $indexNumber)->first();
    
        if ($student) {
            if ($student->date_of_birth !== $dateOfBirth) {
                return back()->with('error', 'Wrong date of birth. Please check your date of birth.');
            } elseif (!$student->eligibility_status) {
                return back()->with('error', 'You are not eligible.');
            } elseif (is_null($student->program_applied)) {
                return back()->with('error', 'You have not applied.');
            } else {
                // Student is authenticated, store the student's ID in the session
                Session::put('student_id', $student->id);
                $redirectURL = route('student.show');
                return redirect($redirectURL);
            }
        } else {
            return back()->with('error', 'Invalid index number. Check your index number.');
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

    public function updatePlacement(Request $request, $id)
    {
        try {
            $student = Student::where('id', $id)->firstOrFail();
    
            $validatedData = $request->validate([
                'contact_number' => 'required|regex:/^\d{8}(\d{3})?$/',
                'placement_id' => 'sometimes|required',
            ]);
    
            $dataToUpdate = [];
    
            if (isset($validatedData['contact_number']) && $validatedData['contact_number'] !== $student->contact_number) {
                $dataToUpdate['contact_number'] = $validatedData['contact_number'];
            }
    
            if (isset($validatedData['placement_id']) && $validatedData['placement_id'] !== $student->placement_id) {
                $dataToUpdate['placement_id'] = $validatedData['placement_id'];
            }
    
            if (!empty($dataToUpdate)) {
                $student->update($dataToUpdate);
            }
    
            return back()->with('success', 'Updated successfully.');
        } catch (\Exception $e) {
            // Handle the exception, such as displaying an error message or logging the error.
            \Log::error($e);
            return back()->with('error', $e->getMessage());
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
        return back()->with('success', 'Student data added.');

        // Redirect or perform any other action after student registration
        // return redirect('/login'); // Redirect to the student list or another page
    }

    public function updateByIndex(Request $request)//apply
    {
        $indexNumber = $request->input('index_number');
        $student = Student::where('index_number', $indexNumber)->first();

        if (!$student) {
            return back()->with('error', 'Invalid index number. Check your index number.')->with('index_number', $indexNumber);
        }

        $math = Student::where('index_number', $indexNumber)
        ->where(function ($query) {
            $query->whereNotNull('mat') //math
                ->orWhereNotNull('bmt');//b math
        })->first();

        if (!$math) {
            return back()->with('error', 'You are not eligible for GCIT CTT.')->with('index_number', $indexNumber);
        }

        try {
            $columnsToCompare = ['eng', 'dzo', 'com', 'acc', 'bmt', 'geo', 'his', 'eco', 'med', 'bent', 'evs', 'rige', 'agfs', 'mat', 'phy', 'che', 'bio'];
            $eligibilityRow = DB::table('eligibility')->first();

            if (!$eligibilityRow) {
                return back()->with('error', 'No eligibility data found. Please try again later.');
            } else {
                $studentData = DB::table('students')
                    ->select($columnsToCompare)
                    ->where('index_number', $indexNumber)
                    ->first();

                $isEligible = true;

                foreach ($columnsToCompare as $column) {
                    $studentValue = $studentData->$column;
                    $eligibilityValue = $eligibilityRow->$column;

                    if (!is_null($studentValue) && !is_null($eligibilityValue) && $studentValue < $eligibilityValue) {
                        $isEligible = false;
                        break;
                    }
                }

                if ($isEligible) {
                    $validatedData = $request->validate([
                        'contact_number' => 'required|regex:/^\d{8}(\d{3})?$/',
                        'program_applied' => 'required',
                    ]);

                    if ($validatedData) {
                        $student->update([
                            'contact_number' => $request->contact_number,
                            'program_applied' => $request->program_applied
                        ]);
                    }

                    $student->update(['eligibility_status' => true]);

                    return back()->with('success', 'You have successfully applied.')->with('index_number', $indexNumber);
                } else {
                    $student->update(['eligibility_status' => false]);
                    return back()->with('error', 'You are not eligible for GCIT CTT.')->with('index_number', $indexNumber);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error($e);
            return back()->with('error', 'Database error. Please try again.');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
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
            'program_applied' => 'nullable',
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
