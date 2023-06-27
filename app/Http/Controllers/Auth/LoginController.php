<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $locale = $request->input('locale');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/' . $locale);
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $locale = App::getLocale();

        return redirect('/' . $locale)->with('success', 'Logout successful');
    }
}
