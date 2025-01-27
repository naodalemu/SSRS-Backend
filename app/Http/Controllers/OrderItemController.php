<?php

namespace App\Http\Controllers;

use App\Models\orderItem;
use App\Models\order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function create($orderId)
{
    $order = order::findOrFail($orderId);
    $menuItems = MenuItem::all();
    return view('Tables.orderitems.create', compact('order', 'menuItems'));
}

public function store(Request $request, $orderId)
{
    if ($request->input('action') === 'add') {
        $validatedData = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = order::find($orderId);

        if (!$order) {
            return redirect()->back()->withErrors(['error' => 'Invalid Order ID']);
        }

        // Fetch the MenuItem and calculate the total for the new order item
        $menuItem = MenuItem::findOrFail($validatedData['menu_item_id']);
        $itemTotal = $menuItem->price * $validatedData['quantity'];

        // Create the order item
        orderItem::create([
            'order_id' => $orderId,
            'menu_item_id' => $menuItem->id,
            'quantity' => $validatedData['quantity'],
        ]);

        // Add the new item's total to the order's total amount
        $order->total_amount += $itemTotal;
        $order->save();

        // Redirect back to the 'create' page to add more items
        return redirect()->route('orderitem.create', ['orderId' => $orderId])
                         ->with('success', 'Order item added successfully.');
    }

    // If the 'done' button is pressed, skip validation and redirect to the order list
    return redirect()->route('order.show', $orderId)
                     ->with('success', 'Order items added successfully.');
}

}
