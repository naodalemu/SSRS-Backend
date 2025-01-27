@extends('layouts.auth')

@section('content')
    <h1>Orders</h1>

    @foreach ($orders as $order)
        <h2>Order #{{ $order->id }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
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
    @endforeach
@endsection
