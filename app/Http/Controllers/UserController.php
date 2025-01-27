<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edit()
    {
        return view('settings.edit', ['user' => Auth::user()]);
    }

   

    public function update(Request $request)
    {
        // Validate the previous password
        $validator = Validator::make($request->all(), [
            'previous_password' => 'required|string',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Check if the previous password matches the current password
        if (!Hash::check($request->previous_password, Auth::user()->password)) {
            return Redirect::back()->withErrors(['previous_password' => 'The previous password is incorrect.']);
        }
        

        // Update user details
        $user = Auth::user();
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return Redirect::route('settings.edit')->with('success', 'Profile updated successfully.');
    }
}


