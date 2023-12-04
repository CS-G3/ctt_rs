<?php

use App\Models\User;
use App\Models\Student;
use App\Models\Placement;
use App\Models\RankingCriteria;
use Illuminate\View\View;
use App\Models\Eligibility;
use App\Models\RegistrationPeriod;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RankingController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::namespace('App\Http\Controllers\Auth')->group(function () {
    // Authentication routes
    Route::get('/login', 'LoginController@show')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');

});

Route::namespace('App\Http\Controllers')->group(function () {
    // student
    Route::get('/student-login', 'StudentController@loginForm')->name('student.loginForm');
    Route::post('/student-login', 'StudentController@login')->name('student.login');
    Route::post('/student-logout', 'StudentController@logout')->name('student.logout');

    Route::post('/add_student', 'StudentController@register')->name('students.add');
    Route::post('/add_archive', 'archiveController@add')->name('archive.add');
    Route::post('/add_registrationDate', 'registrationPeriodController@add')->name('registrationDate.add');
    Route::put('/register-student', 'StudentController@updateByIndex')->name('students.updateByIndex');
    Route::put('/update-student/{id}', 'StudentController@update')->name('student.update'); // update std
    Route::put('/update-student-placement/{id}', 'StudentController@updatePlacement')->name('student.updatePlacement'); // update std
    Route::post('/register', 'UserController@register')->name('register');

    Route::get('/users', 'UserController@getAllUsers');

    Route::delete('/users/{user}', 'UserController@deleteUser')->name('user.delete');

    Route::post('/otp', 'OtpController@sendOtp')->name('otp');
    Route::post('/validate-otp', 'OtpController@validateOtp')->name('validate.otp');
    Route::post('/update-password', 'UserController@updatePassword')->name('update.password');
    Route::post('/update', 'UserController@update')->name('update.user');
    Route::post('/updateNameEmailPassword', 'UserController@updateNameEmailPassword')->name('user.updateNameEmailPassword');
    // Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::get('/user/{id}/edit', 'UserController@editManager')->name('user.edit');
    Route::get('/user/{id}', 'UserController@edit')->name('manager.edit');

    // Route::post('/student-details', 'StudentController@getStudentByIndex')->name('get.student.details');
    // Route::get('/student/{student_id}/dashboard', 'StudentController@show')->name('student.show');
    Route::get('/student/dashboard', 'StudentController@show')->name('student.show');

    Route::post('/update-eligibility', 'eligibilityController@update')->name('update.eligibility');
    Route::delete('/archive/{archive}', 'ArchiveController@delete')->name('archive.delete');
    Route::post('/add_placement', 'PlacementController@add')->name('placement.add');
    // Route::delete('/placement/{placement}', 'PlacementController@delete')->name('placement.delete');
    Route::delete('/placement', 'PlacementController@delete')->name('placement.delete');
    // Route::delete('/registrationPeriod/{registrationPeriod}', 'registrationPeriodController@delete')->name('registrationPeriod.delete');

    Route::get('/admin/search', [UserController::class, 'search'])->name('admin.search');
});

Route::get('/admin/add-user', function () {
    return view('admin/addUser');
});

Route::post('/add-total-intake', [RankingController::class, 'addTotalIntake'])->name('add.total_intake');

Route::get('/manager/dashboard', function () {
    $eligibility = Eligibility::first(); // Fetch the first eligibility record
    $placement = Placement::all();
    //registrationPeriod
    $registrationPeriod = RegistrationPeriod::first();

    $total_intake = RankingCriteria::first()->total_intake;
    $rankingCriteria = RankingCriteria::first(); // Retrieve the first row from the table

    // Check if there's a valid registration period
    if ($registrationPeriod) {
        $startDate = $registrationPeriod->startDate;
        $endDate = $registrationPeriod->endDate;
        $status = $registrationPeriod->status;
        return view('manager/manager_dashboard', compact('eligibility', 'placement', 'status', 'startDate', 'endDate', 'total_intake', 'rankingCriteria'));
    } else {
        $startDate = null; 
        $endDate = null;
        $status = null;
        return view('manager/manager_dashboard', compact('eligibility', 'placement', 'status', 'startDate', 'endDate', 'total_intake', 'rankingCriteria'));
    }
});

// Route::get('/manager/rank', function () {
//     $rankingCriteria = RankingCriteria::first(); // Retrieve the first row from the table
//     // Load data for the selected table from the database
//     $soc = Student::whereNotNull('rank')->orderBy('rank')->paginate(8); // Sort by 'rank'
//     $sidd = Student::whereNotNull('rankSIDD')->orderBy('rankSIDD')->paginate(8); // Adjust the number based on your preference

//     // Return the HTML view for the table
//     // return view('manager/rank', compact('data'));
//     // Pass the data to the view
//     return view('manager/rank', ['rankingCriteria' => $rankingCriteria, 'soc' => $soc, 'sidd' => $sidd]);
// });

Route::get('/manager/rank/soc', function () {
    $rankingCriteria = RankingCriteria::first(); // Retrieve the first row from the table
    $soc = Student::whereNotNull('rank')->orderBy('rank')->paginate(8); // Sort by 'rank'
    return view('manager/rank/ranksoc', ['rankingCriteria' => $rankingCriteria, 'soc' => $soc]);
});

Route::get('/manager/rank/sidd', function () {
    $rankingCriteria = RankingCriteria::first(); // Retrieve the first row from the table
    $sidd = Student::whereNotNull('rankSIDD')->orderBy('rankSIDD')->paginate(8); // Adjust the number based on your preference
    return view('manager/rank/ranksidd', ['rankingCriteria' => $rankingCriteria, 'sidd' => $sidd]);
});

Route::get('/manager/add-student', function () {
    return view('manager/addStudent');
});


Route::get('/manager/archive', 'App\Http\Controllers\ArchiveController@showArchive')->name('archive.view');
Route::delete('manager/archive/{id}', 'App\Http\Controllers\ArchiveController@deleteArchive')->name('archive.delete');

Route::get('/manager/insights', function () {
    // Retrieve data for placements and student count
    $placements = Placement::withCount('students')->get();
    $studentCount = Student::count();

    // Create a new Chart instance
    $chart = new Chart();

    // Set the chart type to 'doughnut' (donut chart)
    $chart->type('doughnut');

    // Labels for each section (replace these with your own labels)
    $labels = $placements->pluck('location')->toArray();

    // Data for each section (replace these with your own data)
    $data = $placements->pluck('students_count')->toArray();

    // Add data to the chart
    $chart->dataset('Number of students', 'doughnut', $data)->backgroundColor([
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
    ]);

    // Set chart labels
    $chart->labels($labels);

    // Set chart options (optional)
    $chart->options([
        'responsive' => true,
        'maintainAspectRatio' => false,
    ]);

    // Pass data to the view
    return view('manager.insights', [
        'placements' => $placements,
        'studentCount' => $studentCount,
        'chart' => $chart,
    ]);
});


Route::get('/admin/dashboard', function () {
    $authUser = User::all();
    $users = User::where('role', 'manager')->get();
    return view('admin/admin_dashboard', compact('users', 'authUser'));
});

// Route::get('/student/dashboard', function () {
//     return view('student/std_dashboard');
// });

Route::get('/ctt-registration', function () {
    // Fetch the start date, end date, and status from the database
    $registrationPeriod = RegistrationPeriod::first();

    // Check if there's a valid registration period
    if ($registrationPeriod) {
        $startDate = $registrationPeriod->startDate;
        $endDate = $registrationPeriod->endDate;
        $status = $registrationPeriod->status;

        return view('student/std_register', compact('startDate', 'endDate', 'status'));
    }

    // If there's no valid registration period, send null values
    return view('student/std_register', [
        'startDate' => null,
        'endDate' => null,
        'status' => null,
    ]);
});

Route::get('/forgot-password', function () {
    return view('forgot_password/forgot_password');
});

Route::get('/validate-otp', function () {
    return view('forgot_password/validate_otp');
});

Route::get('/set-password', function () {
    return view('forgot_password/set_password');
});



//download feature

Route::get('/download', 'App\Http\Controllers\DownloadController@download')->name('archive.download');
Route::post('/archiveP', 'App\Http\Controllers\ArchiveController@add')->name('archive.save');
Route::get('/archive/download/{id}', 'App\Http\Controllers\ArchiveController@download')->name('archive.butDownload');



Route::get('/register_user', function () {
    return view('register_user');
});

// Route::get('/students', 'App\Http\Controllers\StudentController@index')->name('students.index');
// Route::get('/std', function () {
//     return view('std');
// });
Route::post('/import', 'App\Http\Controllers\CsvImportController@import')->name('import.csv');

Route::get('/import', 'App\Http\Controllers\CsvImportController@showUploadForm')->name('import.form');

Route::post('/update-ranking-criteria', 'App\Http\Controllers\RankingController@updateOrCreateRankingCriteria')->name('update-ranking-criteria');
Route::get('/show-form', function () {
    return View::make('rank_criteria');
});


Route::post('/rank-students', 'App\Http\Controllers\RankingController@rank')->name('rankStudents');
Route::get('/load-table/{table}', 'App\Http\Controllers\TableController@loadTable');
