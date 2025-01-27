@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Menu Ingredient</h1>
            <form action="{{ route('menuingredients.update', $menuIngredient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="menu_item_id">Menu Item</label>
                    <select name="menu_item_id" id="menu_item_id" class="form-control">
                        <option value="">Select Menu Item</option>
                        @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}" {{ $menuIngredient->menu_item_id == $menuItem->id ? 'selected' : '' }}>{{ $menuItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ingredient_id">Ingredient</label>
                    <select name="ingredient_id" id="ingredient_id" class="form-control">
                        <option value="">Select Ingredient</option>
                        @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" {{ $menuIngredient->ingredient_id == $ingredient->id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
