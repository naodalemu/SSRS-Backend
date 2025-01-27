@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Order #{{ $order->id }}</h1>
            <p>Table Number: {{ $order->table->table_number }}</p> <!-- Display table_number instead of table_id -->
            <p>Order Date: {{ $order->order_date }}</p>
            <p>Total Amount: ${{ $order->total_amount }}</p>
            <p>Status: {{ $order->order_status }}</p>

            <h2>Order Items</h2>
            @if($order->orderItems->isEmpty())
                <p>No items in this order.</p>
            @else
                <ul>
                    @foreach($order->orderItems as $item)
                        <li>{{ $item->menuItem->name }} (${{ $item->menuItem->price }}) - Quantity: {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
            <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Order</button>
            </form>
        </div>
    </div>
    <a href="{{ route('order.index') }}" class="btn btn-secondary" style="margin-top: 20px;">Back to List</a>
</div>
@endsection
