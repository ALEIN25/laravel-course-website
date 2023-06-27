<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phonenr' => 'required',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phonenr' => $validatedData['phonenr'],
            'role' => 'user',
        ]);
        $locale = $request->input('locale');

        return redirect()->route('login', ['locale' => $locale])->with('message', 'messages.registersuccses');
    }
}

