<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MenuItem; 
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $menuItems = MenuItem::all();

        $salesData = [
            'January' => 120,
            'February' => 150,
            'March' => 90,
            'April' => 200,
            'May' => 130,
        ];

        return view('auth.dashboard', compact('totalUsers', 'menuItems', 'salesData'));
    }
}
