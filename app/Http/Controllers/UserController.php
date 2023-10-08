<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // ...

     // Function to fetch all users
     public function getAllUsers()
     {
         $users = User::all(); // Retrieve all user records from the 'users' table
 
         // You can return the users data to a view or as JSON response
        //  return view('/admin/dashboard', compact('users')); // If returning to a view
         // OR
         return response()->json($users); // If returning JSON response
     }

    public function register(Request $request)
    {
        // Validate user registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create and save a new user record using the User model
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect or perform any other action after registration
        // return redirect('/login'); // Redirect to the dashboard or another page
        return back()->with('success', 'User added successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        // Redirect or return a response after deletion
        return back()->with('success', 'User deleted successfully.');
    }

    // ...
}
