<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderItem;
use App\Models\Table;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Place a new order
    public function store(Request $request)
    {
        try {
            // Log incoming request data to check the structure
            \Log::info($request->all()); 

            // Validate the incoming data, including customer_ip and customer_generated_id
            $validatedData = $request->validate([
                'table_number' => 'required|integer|exists:tables,table_number', // Validate based on table_number
                'order_items' => 'required|array',
                'order_items.*.menu_item_id' => 'required|exists:menu_items,id',
                'order_items.*.quantity' => 'required|integer|min:1',
                'customer_ip' => 'required|ip', // Validate IP address
                'customer_generated_id' => 'required|string|max:255', // Validate customer ID
            ]);

            // Find the table by table_number
            $table = Table::where('table_number', $validatedData['table_number'])->firstOrFail();

            // Create the order with customer_ip and customer_generated_id
            $order = Order::create([
                'table_id' => $table->id, // Use table ID from the found table
                'order_date' => now(),
                'order_status' => 'pending', // Default status
                'total_amount' => 0, // Initially 0, will be updated later
                'customer_ip' => $validatedData['customer_ip'], // Store customer IP
                'customer_generated_id' => $validatedData['customer_generated_id'], // Store customer-generated ID
            ]);

            // Initialize total amount
            $totalAmount = 0;

            // Loop through each order item and create it in the database
            foreach ($validatedData['order_items'] as $item) {
                $menuItem = MenuItem::findOrFail($item['menu_item_id']);
                $orderItem = new OrderItem([
                    'menu_item_id' => $item['menu_item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $menuItem->price,
                ]);

                // Associate the order item with the order
                $order->orderItems()->save($orderItem);

                // Add the item price to the total amount
                $totalAmount += $menuItem->price * $item['quantity'];
            }

            // Update the total amount on the order
            $order->total_amount = $totalAmount;
            $order->save();

            // Update the table status to occupied
            $table->update(['table_status' => 'occupied']);

            // Fetch the order with related order items to send in the response
            $orderWithItems = Order::with('orderItems.menuItem')->find($order->id);

            // Return a success response with the order details
            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $orderWithItems,
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Method to fetch orders for a specific user by customer_ip and customer_generated_id
    public function getUserOrders(Request $request)
    {
        // Retrieve customer_ip and customer_generated_id from the request query parameters
        $customerIp = $request->query('customer_ip');
        $customerGeneratedId = $request->query('customer_generated_id');

        // Query the orders based on customer_ip and/or customer_generated_id
        $query = Order::query();

        if ($customerIp) {
            $query->where('customer_ip', $customerIp);
        }

        if ($customerGeneratedId) {
            $query->where('customer_generated_id', $customerGeneratedId);
        }

        // Fetch the orders with their associated items
        $orders = $query->with('orderItems.menuItem')->get();

        return response()->json(['orders' => $orders]);
    }
}