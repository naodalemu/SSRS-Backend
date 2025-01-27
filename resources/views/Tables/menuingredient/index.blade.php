@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Menu Ingredients</h1>
            <a href="{{ route('menuingredient.create') }}" class="btn btn-primary mb-3">Create New Menu Ingredient</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Menu Item</th>
                        <th>Ingredient</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuIngredients as $menuIngredient)
                    <tr>
                        <td>{{ $menuIngredient->menuItem->name }}</td>
                        <td>{{ $menuIngredient->ingredient->name }}</td>
                        <td>
                            <a href="{{ route('menuingredient.show', $menuIngredient->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('menuingredient.edit', $menuIngredient->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
