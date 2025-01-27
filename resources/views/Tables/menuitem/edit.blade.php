@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Edit MenuItem</h1>
            <form action="{{ route('menuitem.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $menuItem->name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menuItem->description  }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $menuItem->price }}" step="0.01" required>
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
                        <option value="drink" {{ $menuItem->categories == 'Drink' ? 'selected' : '' }}>Drink</option>
                        <option value="food" {{ $menuItem->categories == 'Food' ? 'selected' : '' }}>Food</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file"  id="image" name="image">
                        <label class="custom-file-label" for="image"></label>
                    </div>
                    @if ($menuItem->image)
                        <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="img-fluid mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
