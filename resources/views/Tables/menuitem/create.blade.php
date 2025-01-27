@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create New MenuItem</h1>


    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </div>
            @endif

                <form action="{{ route('menuitem.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <div class="form-check form-check-inline">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" {{ $menuItem->tags->contains($tag) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ingredients</label>
                        @foreach ($ingredients as $ingredient)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ingredients[]" id="{{ $ingredient->id }}" value="{{ $ingredient->id }}" {{ $menuItem->ingredients->contains($ingredient) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $ingredient->id }}">
                                    {{ $ingredient->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>




                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control" id="categories" name="categories" required>
                            <option value="">Select a category</option>
                            <option value="drink">Drink</option>
                            <option value="food">Food</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label></br>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
