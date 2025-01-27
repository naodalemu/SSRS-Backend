@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Ingredient</h1>

            <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $ingredient->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $ingredient->description }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
