@extends('layouts.auth')

@section('content')
    <h1>Edit Order</h1>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="order_date">Order Date</label>
            <input type="date" id="order_date" name="order_date" value="{{ $order->order_date }}">
        </div>

        <h2>Order Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $orderItem)
                    <tr>
                        <td>
                            <input type="text" name="order_items[{{ $loop->index }}][product_name]" value="{{ $orderItem->product_name }}">
                        </td>
                        <td>
                            <input type="number" name="order_items[{{ $loop->index }}][quantity]" value="{{ $orderItem->quantity }}">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="order_items[{{ $loop->index }}][price]" value="{{ $orderItem->price }}">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="order_items[{{ $loop->index }}][total]" value="{{ $orderItem->total }}">
                        </td>
                        <td>
                            <button type="button" class="remove-item">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="add-item">Add Item</button>

        <button type="submit">Update Order</button>
    </form>
@endsection
