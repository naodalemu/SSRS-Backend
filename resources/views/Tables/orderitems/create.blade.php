@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Add Items for Order #{{ $order->id }}</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('orderitem.store', ['orderId' => $order->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="menu_item_id">Menu Item</label>
                    <select class="form-control" id="menu_item_id" name="menu_item_id" required>
                        <option value="">Select a Menu Item</option>
                        @foreach ($menuItems as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                </div>
                <button type="submit" name="action" value="add" class="btn btn-primary">Add Item</button>
                <button type="submit" name="action" value="done" class="btn btn-secondary" onclick="removeValidation()">Done</button>
            </form>
        </div>
    </div>
</div>

<script>
    function removeValidation() {
        // Remove required attribute from form fields before submitting when "Done" is clicked
        document.getElementById('menu_item_id').removeAttribute('required');
        document.getElementById('quantity').removeAttribute('required');
    }
</script>

@endsection
