<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ShippingInformation;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $shippingInformation = ShippingInformation::where('user_id', $user->id)->first();
        return view('profile', compact('user', 'shippingInformation'));
    }
    public function updateShipping(Request $request)
    {
        $user = auth()->user();
    
        $shippingInformation = ShippingInformation::where('user_id', $user->id)->first();
    
        if (!$shippingInformation) {
            $shippingInformation = new ShippingInformation();
            $shippingInformation->user_id = $user->id;
        }
    
        $shippingInformation->options = $request->input('options');
        $shippingInformation->price = $request->input('price');
    
        $shippingInformation->save();
    
        return redirect()->back()->with('success', 'Shipping information updated successfully.');
    }
    
}
