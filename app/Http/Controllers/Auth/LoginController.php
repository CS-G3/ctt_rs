<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            Session::flash('success', 'Login successful.'); // Set success message

            if (Auth::check()) {
                $user = Auth::user();
            
                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'manager') {
                    return redirect('/manager/dashboard');
                } else {
                    return redirect()->route('login');
                }
            }
            
            // return redirect()->intended('/manager/dashboard'); // Redirect to the intended page or another page
        }

        // Authentication failed
        Session::flash('error', 'Invalid credentials. Please try again.'); // Set error message
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->except('password'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Session::flush(); // Flush the session
        Auth::logout(); // Log the user out

        return Redirect('login');

        // // Set cache control headers to prevent caching
        // $response = response()->view('login'); // Replace 'logout' with the actual view or route for logout
        // $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        // $response->header('Pragma', 'no-cache');
        // $response->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    
        // return $response;
    }
    
}
