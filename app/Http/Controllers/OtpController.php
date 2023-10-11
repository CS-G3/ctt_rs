<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // Generate a random OTP (6 digits)
        $otp = rand(100000, 999999);

        // Recipient's email address
        $to_email = $request->input('email'); // Replace with the recipient's email

        echo $to_email;

        // Store the OTP and email in the session
        $request->session()->put('otp', $otp);
        $request->session()->put('email', $to_email);

         // Check if the user with this email exists in your database
        $user = User::where('email', $to_email)->first();

        if (!$user) {
            // User does not exist, handle this case (e.g., return an error response)
            return redirect()->back()->with('error', 'User not found. Please register or check the email address.');
        }

        // Send the OTP via email
        Mail::raw("Your OTP is: $otp", function ($message) use ($to_email) {
            $message->to($to_email)->subject('Your OTP Code');
        });

        // return 'OTP sent successfully.';
        // return redirect('/validate-otp')->with('success', 'OTP sent successfully.');
        return redirect('/validate-otp');
    }

    public function validateOtp(Request $request)
    {
        $otp = $request->input('otp');
        $storedOtp = $request->session()->get('otp');
        $email = $request->session()->get('email');

        // Check if the provided OTP matches the one stored in the session
        if ($otp == $storedOtp) {
            // OTP is valid, you can clear it from the session if needed
            $request->session()->forget('otp');
            // $request->session()->forget('otp_email');

            // Perform any necessary actions (e.g., log the user in) and display a success message
            // return redirect()->route('home')->with('success', 'OTP validated successfully.');
            return redirect('/set-password');
        } else {
            // OTP is not valid, return an error message
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

}
