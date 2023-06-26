<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ShippingInformation;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }
}
