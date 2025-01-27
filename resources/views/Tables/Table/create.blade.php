@extends('layouts.auth')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <h1>Create Tables</h1>
                <form action="{{ route('table.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="table_number">Number of Tables</label>
                        <input type="number" class="form-control" id="table_number" name="table_number" required>
                    </div>

                    <div class="form-group">
                        <label for="base_link">Base Link</label>
                        <input type="url" class="form-control" id="base_link" name="base_link" placeholder="Enter the base link" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Table</button>
                </form>
            </div>
        </div>
    </div>
@endsection
