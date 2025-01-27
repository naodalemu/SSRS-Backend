@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Images</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('image.create') }}" class="btn btn-primary mb-3">
        Create New Image
    </a>

    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $image->name }}</h5>
                    <p class="card-text">{{ $image->description }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('image.show', $image) }}" class="btn btn-primary mr-2">View</a>
                        <a href="{{ route('image.edit', $image) }}" class="btn btn-secondary mr-2">Edit</a>
                        <form action="{{ route('image.destroy', $image) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mr-2">Delete</button>
                        </form>
                        <a href="{{ route('images.store') }}" class="btn btn-success">Create</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
