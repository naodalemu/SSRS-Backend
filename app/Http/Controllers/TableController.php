<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table; // Use the correct model name

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('Tables.Table.index', compact('tables'));
    }

    public function create()

    {
        return view('Tables.Table.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'table_number' => 'required|integer|min:1',
            'base_link' => 'required|url',
            'status' => 'nullable|string',
        ]);

        $lastTable = Table::orderBy('table_number', 'desc')->first();
        $startNumber = $lastTable ? $lastTable->table_number + 1 : 1;

        $tableAmount = (int) $validatedData['table_number'];
        $baseLink = rtrim($validatedData['base_link'], '/');
        $tableStatus = $validatedData['status'] ?? 'free';

        for ($i = 0; $i < $tableAmount; $i++) {
            Table::create([
                'table_number' => $startNumber + $i,
                'qr_code' => url("{$baseLink}/menu/" . ($startNumber + $i)),
                'table_status' => $tableStatus,
            ]);
        }

        return redirect()->route('table.index')->with('success', 'Tables created successfully.');
    }

    public function show($id)
{
    $table = Table::findOrFail($id);
    return view('Tables.Table.show', compact('table'));
}


    public function edit($id)

    {
        $table = Table::find($id);
        return view('Tables.Table.edit', compact('table'));


    }


    public function update(Request $request, Table $table)

    {

        $request->validate([
            'table_number' => 'required|integer|max:255',
            'qr_code' => 'required|string',
            'table_status' => 'required|string|max:255',
        ]);
        $table->update($request->all());



          return redirect()->route('table.index')->with('success', 'Table row updated successfully.');
    }



    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('table.index')->with('success', 'Table row deleted successfully.');
    }
}