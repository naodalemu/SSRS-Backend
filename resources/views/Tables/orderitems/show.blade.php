@extends('layouts.auth')

@section('content')
    <h1>Order #{{ $order->id }}</h1>

    <p>Order Date: {{ $order->order_date }}</p>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->product_name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ formatPrice($orderItem->price) }}</td>
                    <td>{{ formatPrice($orderItem->total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
