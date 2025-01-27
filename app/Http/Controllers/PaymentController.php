<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// PaymentController.php
class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::all();
        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,debit_card,cash',
            'status' => 'required|in:pending,paid,failed',
        ]);

        $payment = Payment::create($validatedData);

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $orders = Order::all();
        return view('payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,debit_card,cash',
            'status' => 'required|in:pending,paid,failed',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($validatedData);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
