@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Menu Ingredient Details</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Menu Item</th>
                        <td>{{ $menuIngredient->menuItem->name }}</td>
                    </tr>
                    <tr>
                        <th>Ingredient</th>
                        <td>{{ $menuIngredient->ingredient->name }}</td>
                    </tr>
                    <!-- Add more rows for any other relevant information -->
                </tbody>
            </table>
            <a href="{{ route('menuingredients.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
