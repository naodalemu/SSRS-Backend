@extends('layouts.auth')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Orders</h1>
            <a href="{{ route('order.create') }}" class="btn btn-primary mb-3">Create New Order</a>

            <!-- Bootstrap Tabs -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-processing-tab" data-bs-toggle="tab" href="#pending-processing" role="tab" aria-controls="pending-processing" aria-selected="true">Pending/Processing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</a>
                </li>
            </ul>

            <div class="tab-content" id="orderTabsContent">
                <!-- Pending/Processing Tab -->
                <div class="tab-pane fade show active" id="pending-processing" role="tabpanel" aria-labelledby="pending-processing-tab">
                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Table Number</th>
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Order Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if(in_array($order->order_status, ['pending', 'processing']))
                                    <tr>
                                        <td>{{ $order->table->table_number ?? 'N/A' }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="order_status" class="form-control form-control-sm status-dropdown" 
                                                    onchange="changeDropdownColor(this); this.form.submit()"
                                                    @if(in_array($order->order_status, ['completed', 'cancelled'])) disabled @endif>
                                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($order->orderItems as $item)
                                                    @if($item->MenuItem)
                                                        <li>{{ $item->MenuItem->name }} - Qty: {{ $item->quantity }}</li>
                                                    @else
                                                        <li>Item not found - Qty: {{ $item->quantity }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm mr-10">View</a>
                                                <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Completed Tab -->
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Table Number</th>
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Order Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if($order->order_status == 'completed')
                                    <tr>
                                        <td>{{ $order->table->table_number ?? 'N/A' }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>Completed</td>
                                        <td>
                                            <ul>
                                                @foreach ($order->orderItems as $item)
                                                    @if($item->MenuItem)
                                                        <li>{{ $item->MenuItem->name }} - Qty: {{ $item->quantity }}</li>
                                                    @else
                                                        <li>Item not found - Qty: {{ $item->quantity }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Cancelled Tab -->
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Table Number</th>
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Order Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if($order->order_status == 'cancelled')
                                    <tr>
                                        <td>{{ $order->table->table_number ?? 'N/A' }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>Cancelled</td>
                                        <td>
                                            <ul>
                                                @foreach ($order->orderItems as $item)
                                                    @if($item->MenuItem)
                                                        <li>{{ $item->MenuItem->name }} - Qty: {{ $item->quantity }}</li>
                                                    @else
                                                        <li>Item not found - Qty: {{ $item->quantity }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to change the <select> dropdown background color based on the selected value
    function changeDropdownColor(dropdown) {
        let value = dropdown.value;

        // Reset background color and text color
        dropdown.style.backgroundColor = '';
        dropdown.style.color = 'black';

        // Change background color based on the selected value
        if (value === 'pending') {
            dropdown.style.backgroundColor = 'white';
        } else if (value === 'processing') {
            dropdown.style.backgroundColor = 'yellow';
        } else if (value === 'completed') {
            dropdown.style.backgroundColor = 'green';
            dropdown.style.color = 'white';
        } else if (value === 'cancelled') {
            dropdown.style.backgroundColor = 'red';
            dropdown.style.color = 'white';
        }
    }

    // Apply the background color when the page loads
    document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
        changeDropdownColor(dropdown);
    });
</script>
@endsection
