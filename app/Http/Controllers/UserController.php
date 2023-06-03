<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phonenr' => 'required',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phonenr' => $validatedData['phonenr'],
            'role' => 'user', // Assign a default role if needed
        ]);

        // Perform any additional actions, such as sending a confirmation email

        // Redirect the user after successful registration
        return redirect('/')->with('success', 'Registration successful. Please log in.');
    }
}
