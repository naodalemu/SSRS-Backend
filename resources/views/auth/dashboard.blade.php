@extends('layouts.auth')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Menu Overview</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Menu</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">QR Code Generation</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Generate QR Code</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Order Management</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Manage Orders</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Customer Feedback</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Feedback</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Orders
            </div>
            <div class="card-body">
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
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Popular Menu Items
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>Dish Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Available</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dish Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Available</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($menuItem as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->categories }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->available ? 'No' : 'Yes' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>

@endsection
