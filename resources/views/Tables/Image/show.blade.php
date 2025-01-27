@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>{{ $image->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid" alt="{{ $image->name }}">
        </div>
        <div class="col-md-6">
            <p>{{ $image->description }}</p>
            <a href="{{ route('images.edit', $image) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('images.destroy', $image) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
