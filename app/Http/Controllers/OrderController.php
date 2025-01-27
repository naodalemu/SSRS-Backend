<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\OrderItem;
use App\Models\Table;

class OrderController extends Controller
{
    // Show the index of all orders
    public function index()
    {
        $orders = order::with('orderItems', 'table')->get();
        return view('Tables.order.index', compact('orders'));
    }

    // Show the form to create a new order
    public function create()
    {
        $tables = Table::all();
        return view('Tables.order.create', compact('tables'));
    }

    // Store a new order in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'table_id' => 'required|integer|exists:tables,id',
            'order_date' => 'required|date',
            'order_status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        // Initialize the total_amount to 0 when creating the order
        $order = order::create([
            'table_id' => $validatedData['table_id'],
            'order_date' => $validatedData['order_date'],
            'order_status' => $validatedData['order_status'],
            'total_amount' => 0 // Set initial total_amount to 0
        ]);

        // Update the table status to 'occupied'
        $table = Table::findOrFail($validatedData['table_id']);
        $table->update(['table_status' => 'occupied']);

        return redirect()->route('orderitem.create', $order->id)
                        ->with('success', 'Order created successfully. Now add order items.');
    }
      

    // Update an existing order
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);
    
        $order = order::findOrFail($id);
    
        // Update only the order_status, as total_amount is handled separately
        $order->update([
            'order_status' => $validatedData['order_status']
        ]);
    
        return redirect()->route('order.index')->with('success', 'Order updated successfully.');
    }
    
    

    // Show a single order
    public function show($id)
    {
        $order = order::with('orderItems.menuItem', 'table')->find($id);
    
        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Order not found');
        }
    
        return view('Tables.order.show', compact('order'));
    }
    

    // Show the edit form for an order
    public function edit($id)
    {
        $order = order::findOrFail($id);

        // Fetch any other data you want to edit, e.g., `menuItems`
        return view('Tables.order.edit', compact('order'));
    }

    // Delete an order
    public function destroy($id)
    {
        $order = order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);
    
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $validatedData['order_status']
        ]);
    
        // If the order is completed or cancelled, free up the table
        if (in_array($validatedData['order_status'], ['completed', 'cancelled'])) {
            $table = Table::findOrFail($order->table_id);
            $table->update(['table_status' => 'free']);
        }
    
        return redirect()->route('order.index')->with('success', 'Order status updated successfully.');
    }
    

}
