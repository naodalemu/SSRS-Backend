@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Create New Order</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="table_id">Table Number</label>
                    <select class="form-control" id="table_id" name="table_id" required>
                        <option value="">Select a Table</option>
                        @foreach ($tables as $table)
                            @if($table->table_status == 'free')
                                <option value="{{ $table->id }}">Table #{{ $table->table_number }}</option>
                            @endif
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="order_date">Order Date</label>
                    <input type="date" class="form-control" id="order_date" name="order_date" required>
                </div>
                <div class="form-group">
                    <label for="order_status">Order Status</label>
                    <select class="form-control" id="order_status" name="order_status" required>
                        <option value="pending" selected>Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
