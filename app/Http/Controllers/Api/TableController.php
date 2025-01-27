<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Retrieve all tables with their status (free or occupied)
    public function index()
    {
        $tables = Table::all(); // Fetch all tables from the database
        return response()->json($tables, 200); // Return tables as JSON response
    }
}
