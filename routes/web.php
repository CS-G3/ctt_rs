<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});

Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

Route::get('/manager/dashboard', function () {
    return view('manager_dashboard');
});

Route::get('/std_login', function () {
    return view('std_login');
});

Route::get('/std_register', function () {
    return view('std_register');
});

Route::post('/add_student', 'App\Http\Controllers\StudentController@register')->name('students.add');

Route::put('/', 'App\Http\Controllers\StudentController@updateByIndex')->name('students.updateByIndex');

Route::get('/forgot_password', function () {
    return view('forgot_password');
});

Route::post('/register', 'App\Http\Controllers\UserController@register')->name('register');

Route::get('/register_user', function () {
    return view('register_user');
});

Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Route::get('/students', 'App\Http\Controllers\StudentController@index')->name('students.index');
// Route::get('/std', function () {
//     return view('std');
// });
