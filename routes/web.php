<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Eligibility;
use App\Models\Placement;

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

// Route::get('/login', function () {
//     return view('login');
// });
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
    // Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::get('/user/{id}/edit', 'UserController@editManager')->name('user.edit');
    Route::get('/user/{id}', 'UserController@edit')->name('manager.edit');

    // Route::post('/student-details', 'StudentController@getStudentByIndex')->name('get.student.details');
    // Route::get('/student/{student_id}/dashboard', 'StudentController@show')->name('student.show');
    Route::get('/student/dashboard', 'StudentController@show')->name('student.show');

    Route::post('/update-eligibility', 'eligibilityController@update')->name('update.eligibility');
    Route::post('/add_placement', 'PlacementController@add')->name('placement.add');
    // Route::delete('/placement/{placement}', 'PlacementController@delete')->name('placement.delete');
    Route::delete('/placement', 'PlacementController@delete')->name('placement.delete');

});

// Route::get('/admin/edit', function () {
//     return view('admin/edit');
// });

Route::get('/manager/dashboard', function () {
    $eligibility = Eligibility::first(); // Fetch the first eligibility record
    $placement = Placement::all();
    return view('manager/manager_dashboard', compact('eligibility', 'placement'));
});

Route::get('/manager/rank', function () {
    return view('manager/rank');
});

Route::get('/manager/archive', function () {
    return view('manager/archive');
});

Route::get('/manager/setting', function () {
    return view('manager/setting');
});

Route::get('/admin/dashboard', function () {
    $authUser = User::all();
    $users = User::where('role', 'manager')->get();
    return view('admin/admin_dashboard', compact('users', 'authUser'));
});

Route::get('/admin/setting', function () {
    return view('setting');
});

// Route::get('/student/dashboard', function () {
//     return view('student/std_dashboard');
// });

Route::get('/ctt-registration', function () {
    return view('student/std_register');
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

Route::get('/register_user', function () {
    return view('register_user');
});

Route::get('/admin/add-user', function () {
    return view('admin/addUser');
});

Route::get('/placement', function () {

    $placement = Placement::all(); // Fetch the first eligibility record

    if (!$placement) {
        // Handle the case where eligibility data is not found
    }
    return view('placement', compact('placement'));
    
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
