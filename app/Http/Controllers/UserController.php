<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\RegistrationWithPassword;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // public function edit()
    // {
    //     $user = auth()->user(); // Get the authenticated user
    //     return view('/sidebar', compact('user'));
    // }

    public function editManager($id)
    {
        $user = User::find($id); // Retrieve the user by ID
        return view('/admin/setting', compact('user'));
    }

    public function edit($id)//user self
    {
        $user = User::find($id); // Retrieve the user by ID
        return view('/manager/setting', compact('user'));
    }

    // In your controller method
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::where('role', 'manager')
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->get();
    
        return view('admin/admin_dashboard', ['users' => $users]);
    }

    public function updateNameEmailPassword(Request $request)
    {
        $user = User::find($request->input('id'));
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        // Validate and update user name and email if provided
        $validatedData = $request->validate([
            'name' => 'nullable|required_if:email,null',
            'email' => 'nullable|required_if:name,null|email',
        ]);
    
        // Check if the new data is different from the old data
        if (($validatedData['name'] && $validatedData['name'] !== $user->name) || 
            ($validatedData['email'] && $validatedData['email'] !== $user->email)) {
    
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->save();
            return back()->with('success', 'User info updated.');
        }
    
        // Validate and update the password if provided
        if ($request->filled('new_password')) {
            $request->validate([
                'new_password' => 'required|string|min:8',
                'confirm_password' => 'required|string|min:8|same:new_password',
                'current_password' => 'required|string|min:8',
            ]);
    
            // Verify the current password before updating the new password
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
                $user->save();
                return back()->with('success', 'User info updated.');
            } else {
                return back()->with('error', 'Current password is incorrect.');
            }
        }
    
        // If no changes were made and no password update, return with a message
        return back()->with('info', 'No changes made.');
    }
    
    public function update(Request $request)
    {
        // $user = auth()->user();

        $user = User::where('id', $request->input('id'))->first();

        // Validate and update user data
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return back()->with('success', 'User updated successfully');
    }

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

            // Send the registration details email with password
        Mail::to($request->input('email'))
            ->send(new RegistrationWithPassword($request->input('name'), $request->input('email'), $request->input('password')));

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

    public function updatePassword(Request $request)
    {
        // Validate the password update data
        $request->validate([
            'email' => 'required|string|email',
            'new_password' => 'required|string|min:8',
        ]);

        // Check if the provided email exists in your database
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        if ($user->save()) {
            // Password updated successfully
            return redirect()->route('login')->with('success', 'User password updated successfully.');
        } else {
            // Password update failed
            return back()->with('error', 'Failed to update password. Please try again.');
        }

        // Redirect or return a response after the password is updated
        // return redirect()->route('reset-password')->with('success', 'Password reset successfully.');
        // return back()->with('success', 'User password updated successfully.');
    }

}
