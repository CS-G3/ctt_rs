<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    Route::post('/register', 'UserController@register')->name('register');

    Route::get('/users', 'UserController@getAllUsers');

    Route::delete('/users/{user}', 'UserController@deleteUser')->name('user.delete');
    
});

Route::get('/manager/dashboard', function () {
    return view('manager_dashboard');
});

Route::get('/admin/dashboard', function () {
    // $users = User::all();
    $users = User::where('role', 'manager')->get();
    return view('admin_dashboard', compact('users'));
});

Route::get('/admin/setting', function () {
    return view('setting');
});

Route::get('/student/dashboard', function () {
    return view('std_dashboard');
});

Route::get('/ctt-registration', function () {
    return view('std_register');
});

Route::get('/forgot_password', function () {
    return view('forgot_password');
});

Route::get('/register_user', function () {
    return view('register_user');
});

// Route::get('/students', 'App\Http\Controllers\StudentController@index')->name('students.index');
// Route::get('/std', function () {
//     return view('std');
// });
