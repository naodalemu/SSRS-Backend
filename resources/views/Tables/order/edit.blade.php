@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Edit Order</h1>
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{--<div class="form-group">
                    <label for="total_amount">Total</label>
                    <input type="number" class="form-control" id="total_amount" name="total_amount" step="0.01" value="{{ $order->total_amount }}" required>
                </div>--}}

                <div class="form-group">
                    <label for="order_status">Status</label>
                    <select class="form-control" id="order_status" name="order_status" required>
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
