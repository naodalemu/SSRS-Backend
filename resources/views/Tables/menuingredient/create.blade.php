@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create New Menu Ingredient</h1>
            <form action="{{ route('menuingredients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="menu_item_id">Menu Item</label>
                    <select name="menu_item_id" id="menu_item_id" class="form-control">
                        <option value="">Select Menu Item</option>
                        @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ingredient_id">Ingredient</label>
                    <select name="ingredient_id" id="ingredient_id" class="form-control">
                        <option value="">Select Ingredient</option>
                        @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
