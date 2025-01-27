@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Tag</h1>

            <form action="{{ route('tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $tag->description }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
