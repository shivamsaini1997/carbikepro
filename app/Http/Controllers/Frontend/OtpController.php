<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Mail\OtpMail;
use App\Models\AllUser;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function generateOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $otpCode = rand(100000, 999999);

        Otp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otpCode]
        );
        Mail::to($request->email)->send(new OtpMail($otpCode));
        return response()->json(['message' => 'OTP generated and sent to your email.']);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:user_otps,email', // Updated to match the table name
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $otpRecord = Otp::where('email', $request->email)->where('otp', $request->otp)->first();

        if ($otpRecord) {
            return response()->json(['message' => 'OTP verified successfully.']);
        } else {
            return response()->json(['error' => 'Invalid OTP.'], 422);
        }
    }
    
    public function usersRegister(Request $request){
        // Validation with custom error messages
        $request->validate([
            'email' => 'required|email|unique:users,email', // Ensure email is unique in 'users' table
            'yourname' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'password' => 'required|string|min:8',
        ], [
            // Custom error messages for validation
            'email.unique' => 'The email address you entered is already taken. Please choose another one.',
            'email.required' => 'The email field is required.',
            'yourname.required' => 'Please provide your name.',
            'phone.required' => 'Phone number is required.',
            'phone.min' => 'The phone number must be 10 digits.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        $user = new AllUser();
        $user->email = $request->email;
        $user->name = $request->yourname;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => 'Register Successfully.']);
    }

    public function usersLogin(Request $request) {
        // Validate input fields with custom error messages
        $request->validate([
            'emaillogin' => 'required|email',
            'passwordlogin' => 'required|string|min:8',
        ], [
            'emaillogin.required' => 'The email field is required.',
            'emaillogin.email' => 'Please enter a valid email address.',
            'passwordlogin.required' => 'Password is required.',
            'passwordlogin.min' => 'Password must be at least 8 characters.',
        ]);
    
        // Prepare credentials array with only email and password
        $credentials = [
            'email' => $request->emaillogin,
            'password' => $request->passwordlogin,
        ];
    
        // Attempt login using the 'alluser' guard
        if (Auth::guard('alluser')->attempt($credentials, $request->remember)) {
            return response()->json(['message' => 'Login Successfully.']);
        }
    
        // Return response for invalid credentials
        return response()->json(['error' => 'Invalid credentials. Please try again.'], 422);
    }
    
    
    

    public function logoutAllUser(Request $request)
    {
        // Log out the user using the 'alluser' guard
        Auth::guard('alluser')->logout();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage with a logout message
        return redirect()->route('homepage')->with('message', 'Logged out successfully.');
    }


    
}
