<?php

namespace App\Http\Controllers;
use App\Models\MenuItem;
use App\Models\order;



class DashboardController extends Controller
{
    public function index()
    {
        $menuItem = menuItem::all();
        $orders = order::all();

        // Return the view with the variable
        return view('auth.dashboard', compact('menuItem', 'orders'));
    }
}
