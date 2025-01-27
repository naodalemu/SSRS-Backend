@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create New Menu Tag</h1>
            <form action="{{ route('menutags.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
